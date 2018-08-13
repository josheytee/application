<div class="row">
    <div class="ntc-product-overview">
        <div class="col-xs-12 col-sm-4 col-md-5 images-container">

            <div id="image-block" class="clearfix">
                <span id="view_full_size">
				<img id="bigpic" itemprop="image"
                     src="{$images->first()->path}"
                     title="Blouse" alt="Blouse" width="458" height="458">
                    <span class="span_link no-print">View larger</span>
                </span>
            </div>

            <div id="views_block" class="clearfix ">
                <span class="view_scroll_spacer">
							<a id="view_scroll_left" class="" title="Other views" href="javascript:{}"
                               style="cursor: default; opacity: 0;">
								Previous
							</a>
                </span>
                <div id="images_thumbnail">
                    <ul id="images_thumbnail_list" style="width: 294px;">
                        {foreach $images as $image}
                            <li id="thumbnail_7" class="image_thumbnail">
                                <a href="" title="Blouse">
                                    <img class="img-responsive" id="thumb_7" src="{$image->path}" alt="Blouse"
                                         title="Blouse" width="80" height="80" itemprop="image">
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                </div>
                <!-- end thumbs_list -->
                <a id="view_scroll_right" title="Other views" href="javascript:{}"
                   style="cursor: default; opacity: 0; display: none;">
                    Next
                </a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h1 itemprop="name">{$name}</h1>
            <p id="product_reference">
                <label>Reference: </label>
                <span class="editable" itemprop="sku" content="demo_1">demo_1</span>
            </p>
            <p id="product_condition">
                <label>Condition: </label>
                <link itemprop="itemCondition" href="https://schema.org/NewCondition">
                <span class="editable">New product</span>
            </p>
            <div id="short_description_block">
                <div id="short_description_content" class="rte align_justify" itemprop="description">
                    <p>{$description|truncate:160}</p>
                </div>

                <p class="buttons_bottom_block">
                    <a href="javascript:{}" class="button">
                        More details
                    </a>
                </p>
                <!---->
            </div> <!-- end short_description_block -->
            <!-- number of item in stock -->
            <p id="pQuantityAvailable" style="display: none;">
                <span id="quantityAvailable">0</span>
                <span id="quantityAvailableTxt">Item</span>
                <span id="quantityAvailableTxtMultiple">Items</span>
            </p>
            <!-- availability or doesntExist -->
            <p id="availability_statut">

            <span id="availability_value"
                  class="label label-danger label-warning">This product is no longer in stock</span>
            </p>
            <p class="warning_inline" id="last_quantities" style="display: none">Warning: Last items in stock!</p>
            <p id="availability_date" style="display: none;">
                <span id="availability_date_label">Availability date:</span>
                <span id="availability_date_value"></span>
            </p>
            <!-- Out of stock hook -->
            <div id="oosHook">

            </div>
            <p class="socialsharing_product list-inline no-print">
                <button data-type="twitter" type="button" class="btn btn-default btn-twitter social-sharing">
                    <i class="icon-twitter"></i> Tweet
                    <!-- <img src="http://localhost/prestashop/modules/socialsharing/img/twitter.gif" alt="Tweet" /> -->
                </button>
                <button data-type="facebook" type="button" class="btn btn-default btn-facebook social-sharing">
                    <i class="icon-facebook"></i> Share
                    <!-- <img src="http://localhost/prestashop/modules/socialsharing/img/facebook.gif" alt="Facebook Like" /> -->
                </button>
                <button data-type="google-plus" type="button" class="btn btn-default btn-google-plus social-sharing">
                    <i class="icon-google-plus"></i> Google+
                    <!-- <img src="http://localhost/prestashop/modules/socialsharing/img/google.gif" alt="Google Plus" /> -->
                </button>
                <button data-type="pinterest" type="button" class="btn btn-default btn-pinterest social-sharing">
                    <i class="icon-pinterest"></i> Pinterest
                    <!-- <img src="http://localhost/prestashop/modules/socialsharing/img/pinterest.gif" alt="Pinterest" /> -->
                </button>
            </p>
            <!-- usefull links-->
            <ul id="usefull_link_block" class="clearfix no-print">
                <li class="print">
                    <a href="javascript:print();">
                        Print
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>