<?php
/**
 * Plugin Name: WooAdvance Settings
 * Description: Advance Settings For WooCommerce Website
 * Version: 1.1
 * Author: Elsner Technologies Pvt. Ltd.
 * Author URI: http://www.elsner.com/
 * Text Domain: wooadvance-settings
 * Copyright: © 2017 Elsner Technologies Pvt. Ltd.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

class WooAdvance_Config {
    public static function etpl_WooAdvanceConfig_init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::etplwac_addtab', 50 );
        add_action( 'woocommerce_settings_tabs_etplwooadvanceconfig', __CLASS__ . '::etplwac_config_tab' );
        add_action( 'woocommerce_update_options_etplwooadvanceconfig', __CLASS__ . '::etplwac_update_config' );
        add_action( 'init','etplwac_core' );
    }
    
    public static function etplwac_addtab( $settings_tabs ) {
        $settings_tabs['etplwooadvanceconfig'] = __( 'WooAdvance Settings', 'wooadvance-settings' );
        return $settings_tabs;
    }
    public static function etplwac_config_tab() {
        woocommerce_admin_fields( self::etplwac_get_settings() );
    }
    public static function etplwac_update_config() {
        woocommerce_update_options( self::etplwac_get_settings() );
    }

    public static function etplwac_get_settings() {
        $etplwooadvanceconfig = array(
            'section_title' => array(
                'name'     => __( 'WooAdvance Settings', 'wooadvance-settings' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'WooAdvanceConfig_section_title'
            ),
            'productperrow' => array(
                'name' => __( 'Number of Products Per Row', 'wooadvance-settings' ),
                'type' => 'number',
                'desc' => __( 'Change number of products per row.', 'wooadvance-settings' ),
                'id'   => 'etplwacnoofproductperrow'
            ),

            'productperpage' => array(
                'name' => __( 'Number of Products Per Page', 'wooadvance-settings' ),
                'type' => 'number',
                'desc' => __( 'Change number of products per page.', 'wooadvance-settings' ),
                'id'   => 'etplwacnoofproductperpage'
            ),

            'breadcrumbdisplay' => array(
                'name' => __( 'Breadcrumb Visibility', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to hide Breadcrumbs on pages', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacbreadcrumbdisplay'
            ),
            'removeorderingdropdown' => array(
                'name' => __( 'Remove the sorting drop down and ordering options', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Remove the sorting drop down and ordering options', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacremoveorderingdropdown'
            ),

            /*** Remove options from orderby drodown ***/
            'removepopularityfrmddl' => array(
                'name' => __( 'Remove Popularity Option', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Remove popularity option from sorting drop down', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacremovepopularityfrmddl'
            ),
            'removeratingfrmddl' => array(
                'name' => __( 'Remove Rating Option', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Remove rating option from sorting drop down', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacremoveratingfrmddl'
            ),
            'removedatefrmddl' => array(
                'name' => __( 'Remove Date Option', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Remove date option from sorting drop down', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacremovedatefrmddl'
            ),
            'removepricefrmddl' => array(
                'name' => __( 'Remove Price Option (Low to High)', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Remove price option(Low to High) from sorting drop down', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacremovepricefrmddl'
            ),
            'removeprice-descfrmddl' => array(
                'name' => __( 'Remove Price Option (High to Low)', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Remove price option(High to Low) from sorting drop down', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacremoveprice-descfrmddl'
            ),

            'removeshowresult' => array(
                'name' => __( 'Remove results count from shop page', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Remove results count from shop page', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacremoveshowresult'
            ),
            
            'hideproprice' => array(
                'name' => __( 'Product Price on shop page', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Hide Product Price from shop page', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwachideproprice'
            ),

            'disprodime' => array(
                'name' => __( 'Display product dimensions', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Display product dimensions on shop page', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacdisprodime'
            ),

            'showskupropage' => array(
                'name' => __( 'Show SKU in products page', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Show SKU in products page', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacshowskupropage'
            ),

            'showprodespropage' => array(
                'name' => __( 'Show product description on shop page', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Show product short description on shop page', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacshowprodespropage'
            ),

             'rmvprisinpropage' => array(
                'name' => __( 'Remove price from single product page', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Remove price from single product page', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacrmvprisinpropage'
            ),

             /*Renaming product tabs*/
             'rnmdescriptiontab' => array(
                'name' => __( 'Enter new name for Description Tab', 'wooadvance-settings' ),
                'type' => 'text',
                'desc' => __( 'Rename Product Description Tab', 'wooadvance-settings' ),
                'id'   => 'etplwacrnmdescriptiontab'
            ),
            'rnmaddlinfotab' => array(
                'name' => __( 'Enter new name for Additional Information Tab', 'wooadvance-settings' ),
                'type' => 'text',
                'desc' => __( 'Rename Product Additional Information Tab', 'wooadvance-settings' ),
                'id'   => 'etplwacrnmaddlinfotab'
            ),
            'rnmreviewstab' => array(
                'name' => __( 'Enter new name for Reviews Tab', 'wooadvance-settings' ),
                'type' => 'text',
                'desc' => __( 'Rename Product Reviews Tab', 'wooadvance-settings' ),
                'id'   => 'etplwacrnmreviewstab'
            ),

            'hidrelprodct' => array(
                'name' => __( 'Hide related products from product page', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Hide related products from product page', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwachidrelprodct'
            ),

            'rmvarprice' => array(
                'name' => __( 'Remove Variation Price', 'wooadvance-settings' ),
                'type' => 'checkbox',
                'desc' => __( 'Check to Remove Variation Price', 'wooadvance-settings' ),
                'default' => 'no',
                'id'   => 'etplwacrmvarprice'
            ),

            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'WooAdvanceConfig_section_end'
            )
        );
        return apply_filters( 'wc_settings_tab_etplwooadvanceconfig', $etplwooadvanceconfig );
    }

}

function etplwac_core()
{   
    $noofproductperrow = WC_Admin_Settings::get_option('etplwacnoofproductperrow');
    if(isset($noofproductperrow) && $noofproductperrow>0 && $noofproductperrow!='')
    {
        if (!function_exists('loop_perrow')) {
            function loop_perrow() {
                return WC_Admin_Settings::get_option('etplwacnoofproductperrow');;
            }
        }
        add_filter('loop_shop_columns', 'loop_perrow',99,1);    
    }

	$noofproductperpage = WC_Admin_Settings::get_option('etplwacnoofproductperpage');
    if(isset($noofproductperpage) && $noofproductperpage>0 && $noofproductperpage!='')
    {
        if (!function_exists('loop_perpage')) {
            function loop_perpage() {
                return WC_Admin_Settings::get_option('etplwacnoofproductperpage');;
            }
        }
        add_filter('loop_shop_per_page', 'loop_perpage',99,1);    
    }

	$breadcrumbdisplayflag = WC_Admin_Settings::get_option('etplwacbreadcrumbdisplay');
    if(isset($breadcrumbdisplayflag) && $breadcrumbdisplayflag=='yes')
    {
       add_filter( 'woocommerce_get_breadcrumb', '__return_false' );
       remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb',99,0); 
    }

    $removeordrdropdown= WC_Admin_Settings::get_option('etplwacremoveorderingdropdown');
    if(isset($removeordrdropdown) && $removeordrdropdown=='yes')
    {
       remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
       remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 30 );
    }

    /*** Remove options from orderby drodown ***/
    $rmpopfrdd= WC_Admin_Settings::get_option('etplwacremovepopularityfrmddl');
    $rmratfrdd= WC_Admin_Settings::get_option('etplwacremoveratingfrmddl');
    $rmdatfrdd= WC_Admin_Settings::get_option('etplwacremovedatefrmddl');
    $rmprifrdd= WC_Admin_Settings::get_option('etplwacremovepricefrmddl');
    $rmprdfrdd= WC_Admin_Settings::get_option('etplwacremoveprice-descfrmddl');

    if(isset($rmpopfrdd) || isset($rmratfrdd)  || isset($rmdatfrdd) || isset($rmprifrdd) || isset($rmprdfrdd)) 
    {
        
        function wacetpl_woocommerce_catalog_orderby($orderby) {
            if(WC_Admin_Settings::get_option('etplwacremovepopularityfrmddl')=='yes'){
                unset($orderby['popularity']); // To remove sort by popularity option
            }
            if(WC_Admin_Settings::get_option('etplwacremoveratingfrmddl')=='yes'){
                unset($orderby['rating']); // To remove sort by average rating option
            }
            if(WC_Admin_Settings::get_option('etplwacremovedatefrmddl')=='yes'){                
                unset($orderby['date']); // To remove sort by newness option
            }
            if(WC_Admin_Settings::get_option('etplwacremovepricefrmddl')=='yes'){                
                unset($orderby['price']); // To remove sort by price: low to high option
            }
            if(WC_Admin_Settings::get_option('etplwacremoveprice-descfrmddl')=='yes'){                
                unset($orderby['price-desc']); // To remove sort by price: high to low
            }
            return $orderby;
        }
        add_filter('woocommerce_catalog_orderby', 'wacetpl_woocommerce_catalog_orderby',20);
    }

    $remoshowrslt = WC_Admin_Settings::get_option('etplwacremoveshowresult');
    if(isset($remoshowrslt) && $remoshowrslt=='yes')
    {
       remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    }

    $hideproductprice = WC_Admin_Settings::get_option('etplwachideproprice');
    if(isset($hideproductprice) && $hideproductprice=='yes')
    {
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',10);
    }

    $showprodime = WC_Admin_Settings::get_option('etplwacdisprodime');
    if(isset($showprodime) && $showprodime=='yes')
    {
      add_action( 'woocommerce_after_shop_loop_item_title', 'wacetpl_product_dimensions', 9 );
		function wacetpl_product_dimensions() {
			global $product,$woocommerce;
			if ( defined( 'WOOCOMMERCE_VERSION' ) && version_compare( WOOCOMMERCE_VERSION, '3', '>=' ) ) {
				$dimensions = wc_format_dimensions($product->get_dimensions(false));
        		if ( $product->has_dimensions() ) {
                	echo '<span class="dimensions">Dimensions: '.$dimensions.'</span>';
				}
			}
			else
			{
				$dimensions = $product->get_dimensions();
				if ( ! empty( $dimensions ) ) {
					echo '<span class="dimensions">Dimensions: '.$dimensions.'</span>';
				}
			}
		}
    }

    $showskuprpg = WC_Admin_Settings::get_option('etplwacshowskupropage');
    if(isset($showskuprpg) && $showskuprpg=='yes')
    {
      add_action( 'woocommerce_after_shop_loop_item_title', 'wacetpl_show_sku',8);
		function wacetpl_show_sku() {
		global $product;
			if ( ! empty( $product->get_sku() ) ) {
			echo '<span>SKU: '.$product->get_sku().'</span><br />';
			}
		}
    }

    $showprodesshoppg = WC_Admin_Settings::get_option('etplwacshowprodespropage');
    if(isset($showprodesshoppg) && $showprodesshoppg=='yes')
    {
		add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt',10);
    }    


    $rmsprisinpg = WC_Admin_Settings::get_option('etplwacrmvprisinpropage');
    if(isset($rmsprisinpg) && $rmsprisinpg=='yes')
    {
	remove_action ( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',10);
	}

	/*** Renaming product tabs ***/
    $rnmdescriptiontab = WC_Admin_Settings::get_option('etplwacrnmdescriptiontab');
    $rnmreviewstab = WC_Admin_Settings::get_option('etplwacrnmreviewstab');
    $rnmaddlinfotab= WC_Admin_Settings::get_option('etplwacrnmaddlinfotab');
    if(isset($rnmdescriptiontab) || isset($rnmreviewstab) || isset($rnmaddlinfotab))
    {
		add_filter( 'woocommerce_product_tabs', 'wacetpl_rename_product_tabs', 30 );
		function wacetpl_rename_product_tabs( $tabs ) {
			if(WC_Admin_Settings::get_option('etplwacrnmdescriptiontab')!=''){         
			$tabs['description']['title'] = __( WC_Admin_Settings::get_option('etplwacrnmdescriptiontab') );
			add_filter( 'woocommerce_product_description_heading', 'isa_product_description_heading' );
 				function isa_product_description_heading() {
					$newtitle=WC_Admin_Settings::get_option('etplwacrnmdescriptiontab');
				    return $newtitle;
				}
			}
			if(WC_Admin_Settings::get_option('etplwacrnmaddlinfotab')!=''){         
			$tabs['additional_information']['title'] = __(WC_Admin_Settings::get_option('etplwacrnmaddlinfotab'));
			add_filter( 'woocommerce_product_additional_information_heading', 'isa_additional_info_heading' );
 				function isa_additional_info_heading() {
					$newtitle=WC_Admin_Settings::get_option('etplwacrnmaddlinfotab');
				    return $newtitle;
				}
			}
			if(WC_Admin_Settings::get_option('etplwacrnmreviewstab')!=''){         
			$tabs['reviews']['title'] = __(WC_Admin_Settings::get_option('etplwacrnmreviewstab'));
			}

		return $tabs;
		}
	}

    $hidrelpro = WC_Admin_Settings::get_option('etplwachidrelprodct');
    if(isset($hidrelpro) && $hidrelpro=='yes')
    {
		remove_action ( 'woocommerce_after_single_product_summary','woocommerce_output_related_products', 20);
	}

	$rmvarprc = WC_Admin_Settings::get_option('etplwacrmvarprice');
    if(isset($rmvarprc) && $rmvarprc=='yes')
    {
		add_filter('woocommerce_variable_price_html','wacetpl_remove_variation_price',10);
		add_filter('woocommerce_grouped_price_html','wacetpl_remove_variation_price',10);
		add_filter('woocommerce_variable_sale_price_html','wacetpl_remove_variation_price',10);
		function wacetpl_remove_variation_price($price){
		return false;
		}
	}

}


WooAdvance_Config::etpl_WooAdvanceConfig_init();
}