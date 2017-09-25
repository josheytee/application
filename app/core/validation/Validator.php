<?php

namespace app\core\validation;

use app\core\http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Translation\Translator;

class Validator {

    /**
     * The array of fallback error messages.
     *
     * @var array
     */
    protected $fallbackMessages = [];

    /**
     * The array of wildcard attributes with their asterisks expanded.
     *
     * @var array
     */
    protected $implicitAttributes = [];

    /**
     * The message bag instance.
     *
     * @var \Illuminate\Support\MessageBag
     */
    protected $messages;

    /**
     * The size related validation rules.
     *
     * @var array
     */
    protected $sizeRules = ['Size', 'Between', 'Min', 'Max'];

    /**
     * The numeric related validation rules.
     *
     * @var array
     */
    protected $numericRules = ['Numeric', 'Integer'];

    /**
     * The validation rules that imply the field is required.
     *
     * @var array
     */
    protected $implicitRules = [
        'Required', 'Filled', 'RequiredWith', 'RequiredWithAll', 'RequiredWithout', 'RequiredWithoutAll',
        'RequiredIf', 'RequiredUnless', 'Accepted', 'Present',
        // 'Array', 'Boolean', 'Integer', 'Numeric', 'String',
    ];

    /**
     * The validation rules which depend on other fields as parameters.
     *
     * @var array
     */
    protected $dependentRules = [
        'RequiredWith', 'RequiredWithAll', 'RequiredWithout', 'RequiredWithoutAll',
        'RequiredIf', 'RequiredUnless', 'Confirmed', 'Same', 'Different', 'Unique',
    ];

    /**
     * @var Request
     */
    private $request;

    /**
     * @var array
     */
    private $rules;
    private $initialRules;
    private $failedRules;
    private $customMessages = [];
    private $translator;
    private $files = [];

    public function __construct(Request $request, $rules = []) {

        $this->request = $request;
//        $this->initialRules = $rules;
        $this->setRules($rules);
        $this->translator = new Translator('en');
    }

    public function setRules($rules) {
        $this->initialRules = $rules;

        $this->rules = [];

        $rules = $this->explodeRules($this->initialRules);

        $this->rules = array_merge($this->rules, $rules);

        return $this;
    }

    public function explodeRules($rules) {
        foreach ($rules as $key => $rule) {
            if (Str::contains($key, '*')) {
                $this->each($key, [$rule]);
                unset($rules[$key]);
            } else {
                $rules[$key] = (is_string($rule)) ? explode('|', $rule) : $rule;
            }
        }
        return $rules;
    }

    /**
     * Validate a given attribute against a rule.
     *
     * @param  string $attribute
     * @param  string $rule
     * @return void
     */
    protected function validate($attribute, $rule) {
        list($rule, $parameters) = $this->parseRule($rule);

        if ($rule == '') {
            return;
        }

        // First we will get the numeric keys for the given attribute in case the field is nested in
        // an array. Then we determine if the given rule accepts other field names as parameters.
        // If so, we will replace any asterisks found in the parameters with the numeric keys.
        if (($keys = $this->getNumericKeys($attribute)) &&
            $this->dependsOnOtherFields($rule)) {
            $parameters = $this->replaceAsterisksInParameters($parameters, $keys);
        }

        // We will get the value for the given attribute from the array of data and then
        // verify that the attribute is indeed validatable. Unless the rule implies
        // that the attribute is required, rules are not run for missing values.
        $value = $this->getValue($attribute);

        $validatable = $this->isValidatable($rule, $attribute, $value);

        $method = "validate{$rule}";

        if ($validatable && !$this->$method($attribute, $value, $parameters, $this)) {
            $this->addFailure($attribute, $rule, $parameters);
        }
    }

    /**
     * Determine if the attribute is validatable.
     *
     * @param  string $rule
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function isValidatable($rule, $attribute, $value) {
        return $this->presentOrRuleIsImplicit($rule, $attribute, $value) &&
            $this->passesOptionalCheck($attribute) &&
            $this->hasNotFailedPreviousRuleIfPresenceRule($rule, $attribute);
    }

    /**
     * Get the value of a given attribute.
     *
     * @param  string $attribute
     * @return mixed
     */
    protected function getValue($attribute) {
        if (!is_null($value = $this->request->all()[$attribute])) {
            return $value;
        } elseif (!is_null($value = $this->request->allFiles()[$attribute])) {
            return $value;
        }
    }

    public function parseRule($rules) {
        if (is_array($rules)) {
            $rules = $this->parseArrayRule($rules);
        } else {
            $rules = $this->parseStringRule($rules);
        }

        $rules[0] = $this->normalizeRule($rules[0]);

        return $rules;
    }

    /**
     * Normalizes a rule so that we can accept short types.
     *
     * @param  string $rule
     * @return string
     */
    protected function normalizeRule($rule) {
        switch ($rule) {
            case 'Int':
                return 'Integer';
            case 'Bool':
                return 'Boolean';
            default:
                return $rule;
        }
    }

    /**
     * Determine if the data passes the validation rules.
     *
     * @return bool
     */
    public function passes() {
        $this->messages = new MessageBag;

        // We'll spin through each rule, validating the attributes attached to that
        // rule. Any error messages will be added to the containers with each of
        // the other error messages, returning true if we don't have messages.
        foreach ($this->rules as $attribute => $rules) {
            foreach ($rules as $rule) {
                $this->validate($attribute, $rule);

                if ($this->shouldStopValidating($attribute)) {
                    break;
                }
            }
        }

        // Here we will spin through all of the "after" hooks on this validator and
        // fire them off. This gives the callbacks a chance to perform all kinds
        // of other validation that needs to get wrapped up in this operation.
//        foreach ($this->after as $after) {
//            call_user_func($after);
//        }
        dump($this->messages->all());

        return count($this->messages->all()) === 0;
    }

    /**
     * Get the fallback messages for the validator.
     *
     * @return array
     */
    public function getFallbackMessages() {
        return $this->fallbackMessages;
    }

    /**
     * Set the fallback messages for the validator.
     *
     * @param  array $messages
     * @return void
     */
    public function setFallbackMessages(array $messages) {
        $this->fallbackMessages = $messages;
    }

    /**
     * Determine if the data fails the validation rules.
     *
     * @return bool
     */
    public function fails() {
        return !$this->passes();
    }

    /**
     * Parse an array based rule.
     *
     * @param  array $rules
     * @return array
     */
    protected function parseArrayRule(array $rules) {
        return [Str::studly(trim(Arr::get($rules, 0))), array_slice($rules, 1)];
    }

    /**
     * Parse a string based rule.
     *
     * @param  string $rules
     * @return array
     */
    protected function parseStringRule($rules) {
        $parameters = [];

        // The format for specifying validation rules and parameters follows an
        // easy {rule}:{parameters} formatting convention. For instance the
        // rule "Max:3" states that the value may only be three letters.
        if (strpos($rules, ':') !== false) {
            list($rules, $parameter) = explode(':', $rules, 2);

            $parameters = $this->parseParameters($rules, $parameter);
        }

        return [Str::studly(trim($rules)), $parameters];
    }

    /**
     * Parse a parameter list.
     *
     * @param  string $rule
     * @param  string $parameter
     * @return array
     */
    protected function parseParameters($rule, $parameter) {
        if (strtolower($rule) == 'regex') {
            return [$parameter];
        }

        return str_getcsv($parameter);
    }

    /**
     * Determine if the field is present, or the rule implies required.
     *
     * @param  string $rule
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function presentOrRuleIsImplicit($rule, $attribute, $value) {
        return $this->validateRequired($attribute, $value) || $this->isImplicit($rule);
    }

    protected function passesOptionalCheck($attribute) {
        if ($this->hasRule($attribute, ['Sometimes'])) {
            return array_key_exists($attribute, Arr::dot($this->data)) || in_array($attribute, array_keys($this->data)) || array_key_exists($attribute, $this->files);
        }

        return true;
    }

    /**
     * Determine if a given rule implies the attribute is required.
     *
     * @param  string $rule
     * @return bool
     */
    protected function isImplicit($rule) {
        return in_array($rule, $this->implicitRules);
    }

    /**
     * Determine if it's a necessary presence validation.
     *
     * This is to avoid possible database type comparison errors.
     *
     * @param  string $rule
     * @param  string $attribute
     * @return bool
     */
    protected function hasNotFailedPreviousRuleIfPresenceRule($rule, $attribute) {
        return in_array($rule, ['Unique', 'Exists']) ? !$this->messages->has($attribute) : true;
    }

    /**
     * Stop on error if "bail" rule is assigned and attribute has a message.
     *
     * @param  string $attribute
     * @return bool
     */
    protected function shouldStopValidating($attribute) {
        if (!$this->hasRule($attribute, ['Bail'])) {
            return false;
        }

        return $this->messages->has($attribute);
    }

    /**
     * Add a failed rule and error message to the collection.
     *
     * @param  string $attribute
     * @param  string $rule
     * @param  array $parameters
     * @return void
     */
    protected function addFailure($attribute, $rule, $parameters) {
        $this->addError($attribute, $rule, $parameters);

        $this->failedRules[$attribute][$rule] = $parameters;
    }

    /**
     * Add an error message to the validator's collection of messages.
     *
     * @param  string $attribute
     * @param  string $rule
     * @param  array $parameters
     * @return void
     */
    protected function addError($attribute, $rule, $parameters) {
        $message = $this->getMessage($attribute, $rule);

        $message = $this->doReplacements($message, $attribute, $rule, $parameters);

        $this->messages->add($attribute, $message);
    }

    /**
     * Get the validation message for an attribute and rule.
     *
     * @param  string $attribute
     * @param  string $rule
     * @return string
     */
    protected function getMessage($attribute, $rule) {
        $lowerRule = Str::snake($rule);

        $inlineMessage = $this->getInlineMessage($attribute, $lowerRule);

        // First we will retrieve the custom message for the validation rule if one
        // exists. If a custom validation message is being used we'll return the
        // custom message, otherwise we'll keep searching for a valid message.
        if (!is_null($inlineMessage)) {
            return $inlineMessage;
        }

        $customKey = "validation.custom.{$attribute}.{$lowerRule}";

        $customMessage = $this->getCustomMessageFromTranslator($customKey);

        // First we check for a custom defined validation message for the attribute
        // and rule. This allows the developer to specify specific messages for
        // only some attributes and rules that need to get specially formed.
        if ($customMessage !== $customKey) {
            return $customMessage;
        }

        // If the rule being validated is a "size" rule, we will need to gather the
        // specific error message for the type of attribute being validated such
        // as a number, file or string which all have different message types.
        elseif (in_array($rule, $this->sizeRules)) {
            return $this->getSizeMessage($attribute, $rule);
        }

        // Finally, if no developer specified messages have been set, and no other
        // special messages apply for this rule, we will just pull the default
        // messages out of the translator service for this validation rule.
        $key = "validation.{$lowerRule}";

        if ($key != ($value = $this->translator->trans($key))) {
            return $value;
        }

        return $this->getInlineMessage(
            $attribute, $lowerRule, $this->fallbackMessages
        ) ?: $key;
    }

    /**
     * Get the inline message for a rule if it exists.
     *
     * @param  string $attribute
     * @param  string $lowerRule
     * @param  array $source
     * @return string|null
     */
    protected function getInlineMessage($attribute, $lowerRule, $source = null) {
        $source = $source ?: $this->customMessages;

        $keys = ["{$attribute}.{$lowerRule}", $lowerRule];

        // First we will check for a custom message for an attribute specific rule
        // message for the fields, then we will check for a general custom line
        // that is not attribute specific. If we find either we'll return it.
        foreach ($keys as $key) {
            foreach (array_keys($source) as $sourceKey) {
                if (Str::is($sourceKey, $key)) {
                    return $source[$sourceKey];
                }
            }
        }
    }

    /**
     * Get the custom error message from translator.
     *
     * @param  string $customKey
     * @return string
     */
    protected function getCustomMessageFromTranslator($customKey) {
        if (($message = $this->translator->trans($customKey)) !== $customKey) {
            return $message;
        }

        $shortKey = preg_replace('/^validation\.custom\./', '', $customKey);

        $customMessages = Arr::dot(
            (array)$this->translator->trans('validation.custom')
        );

        foreach ($customMessages as $key => $message) {
            if (Str::contains($key, ['*']) && Str::is($key, $shortKey)) {
                return $message;
            }
        }

        return $customKey;
    }

    /**
     * Get the proper error message for an attribute and size rule.
     *
     * @param  string $attribute
     * @param  string $rule
     * @return string
     */
    protected function getSizeMessage($attribute, $rule) {
        $lowerRule = Str::snake($rule);

        // There are three different types of size validations. The attribute may be
        // either a number, file, or string so we will check a few things to know
        // which type of value it is and return the correct line for that type.
        $type = $this->getAttributeType($attribute);

        $key = "validation.{$lowerRule}.{$type}";

        return $this->translator->trans($key);
    }

    /**
     * Get the data type of the given attribute.
     *
     * @param  string $attribute
     * @return string
     */
    protected function getAttributeType($attribute) {
        // We assume that the attributes present in the file array are files so that
        // means that if the attribute does not have a numeric rule and the files
        // list doesn't have it we'll just consider it a string by elimination.
        if ($this->hasRule($attribute, $this->numericRules)) {
            return 'numeric';
        } elseif ($this->hasRule($attribute, ['Array'])) {
            return 'array';
        } elseif (array_key_exists($attribute, $this->files)) {
            return 'file';
        }

        return 'string';
    }

    /**
     * Replace all error message place-holders with actual values.
     *
     * @param  string $message
     * @param  string $attribute
     * @param  string $rule
     * @param  array $parameters
     * @return string
     */
    protected function doReplacements($message, $attribute, $rule, $parameters) {
        $value = $this->getAttribute($attribute);

        $message = str_replace(
            [':ATTRIBUTE', ':Attribute', ':attribute'], [Str::upper($value), Str::ucfirst($value), $value], $message
        );

        if (isset($this->replacers[Str::snake($rule)])) {
            $message = $this->callReplacer($message, $attribute, Str::snake($rule), $parameters);
        } elseif (method_exists($this, $replacer = "replace{$rule}")) {
            $message = $this->$replacer($message, $attribute, $rule, $parameters);
        }

        return $message;
    }

    /**
     * Transform an array of attributes to their displayable form.
     *
     * @param  array $values
     * @return array
     */
    protected function getAttributeList(array $values) {
        $attributes = [];

        // For each attribute in the list we will simply get its displayable form as
        // this is convenient when replacing lists of parameters like some of the
        // replacement functions do when formatting out the validation message.
        foreach ($values as $key => $value) {
            $attributes[$key] = $this->getAttribute($value);
        }

        return $attributes;
    }

    /**
     * Get the displayable name of the attribute.
     *
     * @param  string $attribute
     * @return string
     */
    protected function getAttribute($attribute) {
        $primaryAttribute = $this->getPrimaryAttribute($attribute);

        $expectedAttributes = $attribute != $primaryAttribute ? [$attribute, $primaryAttribute] : [$attribute];

        foreach ($expectedAttributes as $expectedAttributeName) {
            // The developer may dynamically specify the array of custom attributes
            // on this Validator instance. If the attribute exists in this array
            // it takes precedence over all other ways we can pull attributes.
            if (isset($this->customAttributes[$expectedAttributeName])) {
                return $this->customAttributes[$expectedAttributeName];
            }

            $key = "validation.attributes.{$expectedAttributeName}";

            // We allow for the developer to specify language lines for each of the
            // attributes allowing for more displayable counterparts of each of
            // the attributes. This provides the ability for simple formats.
            if (($line = $this->translator->trans($key)) !== $key) {
                return $line;
            }
        }

        // When no language line has been specified for the attribute and it is
        // also an implicit attribute we will display the raw attribute name
        // and not modify it with any replacements before we display this.
        if (isset($this->implicitAttributes[$primaryAttribute])) {
            return $attribute;
        }

        return str_replace('_', ' ', Str::snake($attribute));
    }

    /**
     * Get the primary attribute name.
     *
     * For example, if "name.0" is given, "name.*" will be returned.
     *
     * @param  string $attribute
     * @return string
     */
    protected function getPrimaryAttribute($attribute) {
        foreach ($this->implicitAttributes as $unparsed => $parsed) {
            if (in_array($attribute, $parsed)) {
                return $unparsed;
            }
        }

        return $attribute;
    }

    /**
     * Get the displayable name of the value.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return string
     */
    public function getDisplayableValue($attribute, $value) {
        if (isset($this->customValues[$attribute][$value])) {
            return $this->customValues[$attribute][$value];
        }

        $key = "validation.values.{$attribute}.{$value}";

        if (($line = $this->translator->trans($key)) !== $key) {
            return $line;
        }

        return $value;
    }

    /**
     * Validate that an attribute is a valid IP.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function validateIp($attribute, $value) {
        return filter_var($value, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * Validate that an attribute is a valid e-mail address.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function validateEmail($attribute, $value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validate that an attribute is a valid URL.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function validateUrl($attribute, $value) {
        /*
         * This pattern is derived from Symfony\Component\Validator\Constraints\UrlValidator (2.7.4)
         * (c) Fabien Potencier <fabien@symfony.com> http://symfony.com
         */
        $pattern = '~^
            ((aaa|aaas|about|acap|acct|acr|adiumxtra|afp|afs|aim|apt|attachment|aw|barion|beshare|bitcoin|blob|bolo|callto|cap|chrome|chrome-extension|cid|coap|coaps|com-eventbrite-attendee|content|crid|cvs|data|dav|dict|dlna-playcontainer|dlna-playsingle|dns|dntp|dtn|dvb|ed2k|example|facetime|fax|feed|feedready|file|filesystem|finger|fish|ftp|geo|gg|git|gizmoproject|go|gopher|gtalk|h323|ham|hcp|http|https|iax|icap|icon|im|imap|info|iotdisco|ipn|ipp|ipps|irc|irc6|ircs|iris|iris.beep|iris.lwz|iris.xpc|iris.xpcs|itms|jabber|jar|jms|keyparc|lastfm|ldap|ldaps|magnet|mailserver|mailto|maps|market|message|mid|mms|modem|ms-help|ms-settings|ms-settings-airplanemode|ms-settings-bluetooth|ms-settings-camera|ms-settings-cellular|ms-settings-cloudstorage|ms-settings-emailandaccounts|ms-settings-language|ms-settings-location|ms-settings-lock|ms-settings-nfctransactions|ms-settings-notifications|ms-settings-power|ms-settings-privacy|ms-settings-proximity|ms-settings-screenrotation|ms-settings-wifi|ms-settings-workplace|msnim|msrp|msrps|mtqp|mumble|mupdate|mvn|news|nfs|ni|nih|nntp|notes|oid|opaquelocktoken|pack|palm|paparazzi|pkcs11|platform|pop|pres|prospero|proxy|psyc|query|redis|rediss|reload|res|resource|rmi|rsync|rtmfp|rtmp|rtsp|rtsps|rtspu|secondlife|service|session|sftp|sgn|shttp|sieve|sip|sips|skype|smb|sms|smtp|snews|snmp|soap.beep|soap.beeps|soldat|spotify|ssh|steam|stun|stuns|submit|svn|tag|teamspeak|tel|teliaeid|telnet|tftp|things|thismessage|tip|tn3270|turn|turns|tv|udp|unreal|urn|ut2004|vemmi|ventrilo|videotex|view-source|wais|webcal|ws|wss|wtai|wyciwyg|xcon|xcon-userid|xfire|xmlrpc\.beep|xmlrpc.beeps|xmpp|xri|ymsgr|z39\.50|z39\.50r|z39\.50s))://                                 # protocol
            (([\pL\pN-]+:)?([\pL\pN-]+)@)?          # basic auth
            (
                ([\pL\pN\pS-\.])+(\.?([\pL]|xn\-\-[\pL\pN-]+)+\.?) # a domain name
                    |                                              # or
                \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}                 # a IP address
                    |                                              # or
                \[
                    (?:(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){6})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:::(?:(?:(?:[0-9a-f]{1,4})):){5})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){4})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,1}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){3})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,2}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){2})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,3}(?:(?:[0-9a-f]{1,4})))?::(?:(?:[0-9a-f]{1,4})):)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,4}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,5}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,6}(?:(?:[0-9a-f]{1,4})))?::))))
                \]  # a IPv6 address
            )
            (:[0-9]+)?                              # a port (optional)
            (/?|/\S+)                               # a /, nothing or a / with something
        $~ixu';

        return preg_match($pattern, $value) === 1;
    }

    /**
     * Validate that an attribute is an active URL.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function validateActiveUrl($attribute, $value) {
        if ($url = parse_url($value, PHP_URL_HOST)) {
            return count(dns_get_record($url, DNS_A | DNS_AAAA)) > 0;
        }

        return false;
    }

    /**
     * Validate the MIME type of a file is an image MIME type.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function validateImage($attribute, $value) {
        return $this->validateMimes($attribute, $value, ['jpeg', 'png', 'gif', 'bmp', 'svg']);
    }

    /**
     * Validate the guessed extension of a file upload is in a set of file extensions.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param  array $parameters
     * @return bool
     */
    protected function validateMimes($attribute, $value, $parameters) {
        if (!$this->isAValidFileInstance($value)) {
            return false;
        }

        return $value->getPath() != '' && in_array($value->guessExtension(), $parameters);
    }

    /**
     * Validate the MIME type of a file upload attribute is in a set of MIME types.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param  array $parameters
     * @return bool
     */
    protected function validateMimetypes($attribute, $value, $parameters) {
        if (!$this->isAValidFileInstance($value)) {
            return false;
        }

        return $value->getPath() != '' && in_array($value->getMimeType(), $parameters);
    }

    /**
     * Check that the given value is a valid file instance.
     *
     * @param  mixed $value
     * @return bool
     */
    public function isAValidFileInstance($value) {
        if ($value instanceof UploadedFile && !$value->isValid()) {
            return false;
        }

        return $value instanceof File;
    }

    /**
     * Validate that an attribute contains only alphabetic characters.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function validateAlpha($attribute, $value) {
        return is_string($value) && preg_match('/^[\pL\pM]+$/u', $value);
    }

    /**
     * Validate that an attribute contains only alpha-numeric characters.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function validateAlphaNum($attribute, $value) {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        return preg_match('/^[\pL\pM\pN]+$/u', $value);
    }

    /**
     * Validate that an attribute contains only alpha-numeric characters, dashes, and underscores.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function validateAlphaDash($attribute, $value) {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        return preg_match('/^[\pL\pM\pN_-]+$/u', $value);
    }

    /**
     * Validate that an attribute passes a regular expression check.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param  array $parameters
     * @return bool
     */
    protected function validateRegex($attribute, $value, $parameters) {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        $this->requireParameterCount(1, $parameters, 'regex');

        return preg_match($parameters[0], $value);
    }

    /**
     * Validate that an attribute is a valid date.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function validateDate($attribute, $value) {
        if ($value instanceof DateTime) {
            return true;
        }

        if (strtotime($value) === false) {
            return false;
        }

        $date = date_parse($value);

        return checkdate($date['month'], $date['day'], $date['year']);
    }

    /**
     * Validate that a required attribute exists.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    protected function validateRequired($attribute, $value) {
        if (is_null($value)) {
            return false;
        } elseif (is_string($value) && trim($value) === '') {
            return false;
        } elseif ((is_array($value) || $value instanceof Countable) && count($value) < 1) {
            return false;
        } elseif ($value instanceof File) {
            return (string)$value->getPath() != '';
        }

        return true;
    }

    /**
     * Validate the size of an attribute.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param  array $parameters
     * @return bool
     */
    protected function validateSize($attribute, $value, $parameters) {
        $this->requireParameterCount(1, $parameters, 'size');

        return $this->getSize($attribute, $value) == $parameters[0];
    }

    /**
     * Validate the size of an attribute is between a set of values.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param  array $parameters
     * @return bool
     */
    protected function validateBetween($attribute, $value, $parameters) {
        $this->requireParameterCount(2, $parameters, 'between');

        $size = $this->getSize($attribute, $value);

        return $size >= $parameters[0] && $size <= $parameters[1];
    }

    /**
     * Validate the size of an attribute is greater than a minimum value.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param  array $parameters
     * @return bool
     */
    protected function validateMin($attribute, $value, $parameters) {
        $this->requireParameterCount(1, $parameters, 'min');

        return $this->getSize($attribute, $value) >= $parameters[0];
    }

    /**
     * Validate the size of an attribute is less than a maximum value.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param  array $parameters
     * @return bool
     */
    protected function validateMax($attribute, $value, $parameters) {
        $this->requireParameterCount(1, $parameters, 'max');

        if ($value instanceof UploadedFile && !$value->isValid()) {
            return false;
        }

        return $this->getSize($attribute, $value) <= $parameters[0];
    }

    /**
     * Get the size of an attribute.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return mixed
     */
    protected function getSize($attribute, $value) {
        $hasNumeric = $this->hasRule($attribute, $this->numericRules);

        // This method will determine if the attribute is a number, string, or file and
        // return the proper size accordingly. If it is a number, then number itself
        // is the size. If it is a file, we take kilobytes, and for a string the
        // entire length of the string will be considered the attribute size.
        if (is_numeric($value) && $hasNumeric) {
            return $value;
        } elseif (is_array($value)) {
            return count($value);
        } elseif ($value instanceof File) {
            return $value->getSize() / 1024;
        }

        return mb_strlen($value);
    }

    /**
     * Get all attributes.
     *
     * @return array
     */
    public function attributes() {
        return array_merge($this->request->all(), $this->files);
    }

    /**
     * Checks if an attribute exists.
     *
     * @param  string $attribute
     * @return bool
     */
    public function hasAttribute($attribute) {
        return Arr::has($this->attributes(), $attribute);
    }

    /**
     * Determine if the given attribute has a rule in the given set.
     *
     * @param  string $attribute
     * @param  string|array $rules
     * @return bool
     */
    protected function hasRule($attribute, $rules) {
        return !is_null($this->getRule($attribute, $rules));
    }

    /**
     * Get a rule and its parameters for a given attribute.
     *
     * @param  string $attribute
     * @param  string|array $rules
     * @return array|null
     */
    protected function getRule($attribute, $rules) {
        if (!array_key_exists($attribute, $this->rules)) {
            return;
        }

        $rules = (array)$rules;

        foreach ($this->rules[$attribute] as $rule) {
            list($rule, $parameters) = $this->parseRule($rule);

            if (in_array($rule, $rules)) {
                return [$rule, $parameters];
            }
        }
    }

    /**
     * Require a certain number of parameters to be present.
     *
     * @param  int $count
     * @param  array $parameters
     * @param  string $rule
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    protected function requireParameterCount($count, $parameters, $rule) {
        if (count($parameters) < $count) {
            throw new InvalidArgumentException("Validation rule $rule requires at least $count parameters.");
        }
    }

    /**
     * Determine if the given rule depends on other fields.
     *
     * @param  string $rule
     * @return bool
     */
    protected function dependsOnOtherFields($rule) {
        return in_array($rule, $this->dependentRules);
    }

    /**
     * Get the numeric keys from an attribute flattened with dot notation.
     *
     * E.g. 'foo.1.bar.2.baz' -> [1, 2]
     *
     * @param  string $attribute
     * @return array
     */
    protected function getNumericKeys($attribute) {
        if (preg_match_all('/\.(\d+)\./', $attribute, $keys)) {
            return $keys[1];
        }

        return [];
    }

    /**
     * Formats values of each fields.
     *
     * @since 1.5.0.1
     *
     * @param int $type FORMAT_COMMON or FORMAT_LANG or FORMAT_SHOP
     * @param int $id_lang If this parameter is given, only take lang fields
     *
     * @return array
     */
    protected function formatFields($type, $id_lang = null) {
        $fields = array();

        // Set primary key in fields
        if (isset($this->id)) {
            $fields[$this->def['primary']] = $this->id;
        }
        foreach ($this->rules as $field => $data) {
            // Only get fields we need for the type
            // E.g. if only lang fields are filtered, ignore fields without lang => true
            if (($type == self::FORMAT_LANG && empty($data['lang'])) || ($type == self::FORMAT_SHOP && empty($data['shop'])) || ($type == self::FORMAT_COMMON && ((!empty($data['shop']) && $data['shop'] !== 'both') || !empty($data['lang'])))) {
                continue;
            }

            if (is_array($this->update_fields)) {
                if ((!empty($data['lang']) || (!empty($data['shop']) && $data['shop'] != 'both')) && (empty($this->update_fields[$field]) || ($type == self::FORMAT_LANG && empty($this->update_fields[$field][$id_lang])))) {
                    continue;
                }
            }

            // Get field value, if value is multilang and field is empty, use value from default lang
            $value = $this->$field;
            if ($type == self::FORMAT_LANG && $id_lang && is_array($value)) {
                if (!empty($value[$id_lang])) {
                    $value = $value[$id_lang];
                } else if (!empty($data['required'])) {
                    $value = $value[Configuration::get('PS_LANG_DEFAULT')];
                } else {
                    $value = '';
                }
            }

            $purify = (isset($data['validate']) && Tools::strtolower($data['validate']) == 'iscleanhtml') ? true : false;
            // Format field value
            $fields[$field] = ObjectModel::formatValue($value, $data['type'], false, $purify, !empty($data['allow_null']));
        }

        return $fields;
    }

    /**
     * Formats a value
     *
     * @param mixed $value
     * @param int $type
     * @param bool $with_quotes
     * @param bool $purify
     * @param bool $allow_null
     *
     * @return mixed
     */
    public static function formatValue($value, $type, $with_quotes = false, $purify = true, $allow_null = false) {
        if ($allow_null && $value === null) {
            return array('type' => 'sql', 'value' => 'NULL');
        }

        switch ($type) {
            case self::TYPE_INT:
                return (int)$value;

            case self::TYPE_BOOL:
                return (int)$value;

            case self::TYPE_FLOAT:
                return (float)str_replace(',', '.', $value);

            case self::TYPE_DATE:
                if (!$value) {
                    return '1995-01-01 00:00:00';
                }

                if ($with_quotes) {
                    return '\'' . DB::getInstance()->escape($value) . '\'';
                }
                return DB::getInstance()->escape($value);

            case self::TYPE_HTML:
                if ($purify) {
                    $value = Tools::purifyHTML($value);
                }
                if ($with_quotes) {
                    return '\'' . DB::getInstance()->escape($value, true) . '\'';
                }
                return DB::getInstance()->escape($value, true);

            case self::TYPE_SQL:
                if ($with_quotes) {
                    return '\'' . DB::getInstance()->escape($value, true) . '\'';
                }
                return DB::getInstance()->escape($value, true);

            case self::TYPE_NOTHING:
                return $value;

            case self::TYPE_STRING:
            default :
                if ($with_quotes) {
                    return '\'' . DB::getInstance()->escape($value) . '\'';
                }
                return DB::getInstance()->escape($value);
        }
    }

    /**
     * Validate a single field
     *
     * @since 1.5.0.1
     *
     * @param string $field Field name
     * @param mixed $value Field value
     * @param int|null $id_lang Language ID
     * @param array $skip Array of fields to skip.
     * @param bool $human_errors If true, uses more descriptive, translatable error strings.
     *
     * @return string|true True or error message string.
     * @throws \Exception
     */
    public function validateField($field, $value, $id_lang = null, $skip = array(), $human_errors = true) {

        $data = $this->rules[$field];
        // Check if field is required
        $required_fields = (isset(self::$fieldsRequiredDatabase[get_class($this)])) ? self::$fieldsRequiredDatabase[get_class($this)] : array();
        $ps_lang_default = 0;
        if (!$id_lang || $id_lang == $ps_lang_default) {
            if (!in_array('required', $skip) && (!empty($data['required']) || in_array($field, $required_fields))) {
                if (Tools::isEmpty($value)) {
                    if ($human_errors) {
                        return sprintf(Tools::displayError('The %s field is required.'), $this->displayFieldName($field, get_class($this)));
                    } else {
                        return 'Property ' . get_class($this) . '->' . $field . ' is empty';
                    }
                }
            }
        }
        // Default value
        if (!$value && !empty($data['default'])) {
            $value = $data['default'];
            $this->request->all()[$field] = $value;
        }

        // Check field values
        if (!in_array('values', $skip) && !empty($data['values']) && is_array($data['values']) && !in_array($value, $data['values'])) {
            return 'Property ' . get_class($this) . '->' . $field . ' has bad value (allowed values are: ' . implode(', ', $data['values']) . ')';
        }

        // Check field size
        if (!in_array('size', $skip) && !empty($data['size'])) {
            $size = $data['size'];
            if (!is_array($data['size'])) {
                $size = array('min' => 0, 'max' => $data['size']);
            }

            $length = Tools::strlen($value);
            if ($length < $size['min'] || $length > $size['max']) {
                if ($human_errors) {
                    if (isset($data['lang']) && $data['lang']) {
                        $language = new Language((int)$id_lang);
                        return sprintf(Tools::displayError('The field %1$s (%2$s) is too long (%3$d chars max, html chars including).'), $this->displayFieldName($field, get_class($this)), $language->name, $size['max']);
                    } else {
                        return sprintf(Tools::displayError('The %1$s field is too long (%2$d chars max).'), $this->displayFieldName($field, get_class($this)), $size['max']);
                    }
                } else {
                    return 'Property ' . get_class($this) . '->' . $field . ' length (' . $length . ') must be between ' . $size['min'] . ' and ' . $size['max'];
                }
            }
        }

        // Check field validator
        if (!in_array('validate', $skip) && !empty($data['validate'])) {
            if (!method_exists(Tools::getNamespacedClass('Validate'), $data['validate'])) {
                throw new \Exception('Validation function not found. ' . $data['validate']);
            }

            if (!empty($value)) {
                $res = true;
                if (Tools::strtolower($data['validate']) == 'iscleanhtml') {
                    //u can allow iframe here
                    if (!call_user_func(array(Tools::getNamespacedClass('Validate'), $data['validate']), $value, false)) {
                        $res = false;
                    }
                } else {
                    if (!call_user_func(array(Tools::getNamespacedClass('Validate'), $data['validate']), $value)) {
                        $res = false;
                    }
                }
                if (!$res) {
                    if ($human_errors) {
                        return sprintf(Tools::displayError('The %s field is invalid.'), $this->displayFieldName($field, get_class($this)));
                    } else {
                        return 'Property ' . get_class($this) . '->' . $field . ' is not valid';
                    }
                }
            }
        }

        return true;
    }

    /**
     * Checks if object field values are valid before database interaction
     *
     * @param bool $die
     * @param bool $error_return
     *
     * @return bool|string True, false or error message.
     * @throws \Exception
     */
    public function validateFields($die = true, $error_return = false) {
        foreach ($this->rules as $field => $data) {
            if (!empty($data['lang'])) {
                continue;
            }

//            if (is_array($this->update_fields) && empty($this->update_fields[$field]) && isset($this->rules[$field]['shop']) && $this->rules[$field]['shop']) {
//                continue;
//            }

            $message = $this->validateField($field, $this->request->all()[$field]);
            if ($message !== true) {
                if ($die) {
                    throw new \Exception($message);
                }
                return $error_return ? $message : false;
            }
        }

        return true;
    }

    /**
     * Returns field name translation
     *
     * @param string $field Field name
     * @param string $class ObjectModel class name
     * @param bool $htmlentities If true, applies htmlentities() to result string
     * @param Context|null $context Context object
     *
     * @return string
     */
    public static function displayFieldName($field, $class = __CLASS__, $htmlentities = true, Context $context = null) {
        global $_FIELDS;

//        if (!isset($context)) {
//            $context = Context::getContext();
//        }
//        if ($_FIELDS === null && file_exists(_PS_TRANSLATIONS_DIR_ . $context->language->iso_code . '/fields.php')) {
//            include_once(_PS_TRANSLATIONS_DIR_ . $context->language->iso_code . '/fields.php');
//        }

        $key = $class . '_' . md5($field);
        return ((is_array($_FIELDS) && array_key_exists($key, $_FIELDS)) ? ($htmlentities ? htmlentities($_FIELDS[$key], ENT_QUOTES, 'utf-8') : $_FIELDS[$key]) : $field);
    }

}
