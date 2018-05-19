<?php

namespace app\core\theme;

/**
 * Defines a theme and its information needed at runtime.
 *
 * The theme manager will store the active theme object.
 *
 * @see \app\core\theme\ThemeManager
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ActiveTheme
{

    /**
     * The name of the active theme.
     *
     * @var string
     */
    protected $name;

    /**
     * The path to the theme.
     *
     * @var string
     */
    protected $path;

    /**
     * The engine of the theme.
     *
     * @var string
     */
    protected $engine;

    /**
     * The path to the theme engine for root themes.
     *
     * @var string
     */
    protected $owner;

    /**
     * An array of base theme active theme objects keyed by name.
     *
     * @var static[]
     */
    protected $base_themes;

    /**
     * The libraries provided by the theme.
     *
     * @var array
     */
    protected $libraries;

    /**
     * The regions provided by the theme.
     *
     * @var array
     */
    protected $regions;

    protected $main_region;
    protected $config;
    protected $extension;

    /**
     * The libraries or library assets overridden by the theme.
     *
     * @var array
     */
    protected $libraries_override;
    protected $template_dir = '/templates';
    protected $libraries_extend;

    /**
     * Constructs an ActiveTheme object.
     *
     * @param array $values
     *   The properties of the object, keyed by the names.
     */
    public function __construct(array $values)
    {
        $values += [
            'path' => '',
            'engine' => 'smarty',
            'owner' => 'smarty',
            'libraries' => [],
            'extension' => '.tpl',
            'base_themes' => [],
            'regions' => [],
            'main_region' => 'content',
            'libraries_override' => [],
            'libraries_extend' => [],
            'config' => [],
        ];

        $this->name = $values['name'];
        $this->path = $values['path'];
        $this->engine = $values['engine'];
        $this->owner = $values['owner'];
        $this->libraries = $values['libraries'];
        $this->extension = $values['extension'];
        $this->config = $values['config'];
        $this->base_themes = $values['base_themes'];
        $this->regions = $values['regions'];
        $this->main_region = $values['main_region'];
        $this->libraries_override = $values['libraries_override'];
        $this->libraries_extend = $values['libraries_extend'];
    }

    /**
     * Returns the machine name of the theme.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the theme engine.
     *
     * @return string
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Returns the path to the theme engine for root themes.
     * @todo remove this
     *
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Returns the libraries provided by the theme.
     *
     * @return mixed
     */
    public function getLibraries()
    {
        return $this->libraries;
    }

    /**
     * The regions used by the theme.
     * @return string[] The list of region machine names supported by the theme.
     * The list of region machine names supported by the theme.
     * @throws \Exception
     * @see system_region_list()
     */
    public function getRegions()
    {
        if (!is_null($this->regions))
            return array_keys($this->regions);
        throw new \Exception('regions must defined inside ' . $this->name . '.info.yml file');
    }
  public function getMainRegion()
    {
       return $this->main_region;
    }

    /**
     * Returns the libraries or library assets overridden by the active theme.
     *
     * @return array
     *   The list of libraries overrides.
     */
    public function getLibrariesOverride()
    {
        return $this->libraries_override;
    }

    /**
     * Returns the libraries extended by the active theme.
     *
     * @return array
     *   The list of libraries-extend definitions.
     */
    public function getLibrariesExtend()
    {
        return $this->libraries_extend;
    }

    /**
     *
     * @param type $template
     * @return string
     * @throws \Exception
     */
    public function getTemplate($template)
    {
        $file = $this->getPath() . $this->getTemplateDir() . DS . $template . $this->getExtension();
        if ($this->getBaseThemes()) {

        }
        return $file;
    }

    /**
     * Returns the path to the theme directory.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getTemplateDir()
    {
        return $this->template_dir;
    }

    public function setTemplateDir($template_dir)
    {
        $this->template_dir = $template_dir;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Returns an array of base theme active theme objects keyed by name.
     *
     * The order starts with the base theme of $this and ends with the root of
     * the dependency chain.
     *
     * @return static[]
     */
    public function getBaseThemes()
    {
        return $this->base_themes;
    }

    public function getConfig($section = null)
    {
        return $section ? $this->config[$section] ?? [] : $this->config ?? [];
    }

    public function setConfig($key, $value)
    {

    }
}
