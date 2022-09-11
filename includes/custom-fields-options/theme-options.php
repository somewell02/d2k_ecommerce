<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', 'Настройки темы' )
	->add_tab( 'Общие', array(
		Field::make( 'image', 'd2k_logo', 'Логотип' ),
		Field::make( 'text', 'd2k_phone', 'Телефон' ),
		Field::make( 'text', 'd2k_email', 'Email' )
	) )
	->add_tab( 'Социальные сети', array(
		Field::make( 'text', 'd2k_social_vk', 'Вконтакте' ),
		Field::make( 'text', 'd2k_social_inst', 'Instagram' ),
		Field::make( 'text', 'd2k_social_inst_nick', 'Instagram nickname' ),
		Field::make( 'text', 'd2k_social_fb', 'Facebook' ),
		Field::make( 'text', 'd2k_social_tg', 'Telegram' ),
	) )
	->add_tab( 'Дополнительно', array(
		Field::make( 'text', 'd2k_footer_copy', 'Копирайт' ),
		Field::make( 'text', 'd2k_thankyou_title', 'Спасибо за заказ' )
	) )
	->add_tab( 'Заставка', array(
		Field::make( 'image', 'd2k_pl_logo', 'Логотип' ),
		Field::make( 'text', 'd2k_pl_title', 'Заголовок' ),
		Field::make( 'text', 'd2k_pl_slogan', 'Слоган' )
	) )
	->add_tab( 'Заголовки', array(
		Field::make( 'text', 'd2k_cross_sells_title', 'Заголовок cross-sells' ),
		Field::make( 'text', 'd2k_up_sells_title', 'Заголовок up-sells' ),
		Field::make( 'text', 'd2k_preorder_title_product', 'Предупреждение предзаказа в товаре' ),
		Field::make( 'text', 'd2k_preorder_title_cart', 'Предупреждение предзаказа в корзине' )
	) )
	->add_tab( 'Оплата', array(
		Field::make( 'checkbox', 'd2k_payment_method_visa', 'Visa' ),
		Field::make( 'checkbox', 'd2k_payment_method_mastercard', 'Mastercard' ),
		Field::make( 'checkbox', 'd2k_payment_method_mir', 'Mir' ),
		Field::make( 'checkbox', 'd2k_payment_method_apple_pay', 'Apple pay' ),
		Field::make( 'checkbox', 'd2k_payment_method_google_pay', 'Google pay' ),
	) )
	->add_tab( 'О нас', array(
		Field::make( 'textarea', 'd2k_about_us_desc', 'Описание' ),
		Field::make( 'text', 'd2k_feedback_form', 'Шорткод feedback формы' ),
		//Field::make( 'media_gallery', 'd2k_about_us_media', 'Медиа' ),
	) );