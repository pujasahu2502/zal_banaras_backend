var CLOSE = 'Close Categories'
var MORE = 'More Categories'
var POSSLIDESHOW_SPEED = '5000'
var POS_HOME_PRODUCTTAB_ITEMS = 5
var POS_HOME_PRODUCTTAB_NAV = false
var POS_HOME_PRODUCTTAB_PAGINATION = false
var POS_HOME_PRODUCTTAB_SPEED = 3000
var POS_HOME_SELLER_ITEMS = 5
var POS_HOME_SELLER_NAV = true
var POS_HOME_SELLER_PAGINATION = false
var POS_HOME_SELLER_SPEED = 1000
var VMEGAMENU_POPUP_EFFECT = '2'
var catSelected = 5
var prestashop = {
  cart: {
    products: [],
    totals: {
      total: { type: 'total', label: 'Total', amount: 0, value: '$0.00' },
      total_including_tax: {
        type: 'total',
        label: 'Total (tax incl.)',
        amount: 0,
        value: '$0.00',
      },
      total_excluding_tax: {
        type: 'total',
        label: 'Total (tax excl.)',
        amount: 0,
        value: '$0.00',
      },
    },
    subtotals: {
      products: {
        type: 'products',
        label: 'Subtotal',
        amount: 0,
        value: '$0.00',
      },
      discounts: null,
      shipping: {
        type: 'shipping',
        label: 'Shipping',
        amount: 0,
        value: 'Free',
      },
      tax: { type: 'tax', label: 'Taxes', amount: 0, value: '$0.00' },
    },
    products_count: 0,
    summary_string: '0 items',
    labels: { tax_short: '(tax excl.)', tax_long: '(tax excluded)' },
    id_address_delivery: 0,
    id_address_invoice: 0,
    is_virtual: false,
    vouchers: { allowed: 0, added: [] },
    discounts: [],
    minimalPurchase: 0,
    minimalPurchaseRequired: '',
  },
  currency: {
    name: 'IN Rupee',
    iso_code: 'INR',
    iso_code_num: '840',
    sign: '₹',
  },
  customer: {
    lastname: null,
    firstname: null,
    email: null,
    last_passwd_gen: null,
    birthday: null,
    newsletter: null,
    newsletter_date_add: null,
    ip_registration_newsletter: null,
    optin: null,
    website: null,
    company: null,
    siret: null,
    ape: null,
    outstanding_allow_amount: 0,
    max_payment_days: 0,
    note: null,
    is_guest: 0,
    id_shop: null,
    id_shop_group: null,
    id_default_group: 1,
    date_add: null,
    date_upd: null,
    reset_password_token: null,
    reset_password_validity: null,
    id: null,
    is_logged: false,
    gender: { type: null, name: null, id: null },
    risk: { name: null, color: null, percent: null, id: null },
    addresses: [],
  },
  language: {
    name: 'English (English)',
    iso_code: 'en',
    locale: 'en-US',
    language_code: 'en-us',
    is_rtl: '0',
    date_format_lite: 'm/d/Y',
    date_format_full: 'm/d/Y H:i:s',
    id: 1,
  },
  page: {
    title: '',
    canonical: null,
    meta: {
      title: 'Mirora 2 - Responsive Prestashop Theme',
      description: 'Shop powered by PrestaShop',
      keywords: '',
      robots: 'index',
    },
    page_name: 'index',
    body_classes: {
      'lang-en': true,
      'lang-rtl': false,
      'country-US': true,
      'currency-USD': true,
      'layout-full-width': true,
      'page-index': true,
      'tax-display-disabled': true,
    },
    admin_notifications: [],
  },
  shop: {
    name: 'Mirora 2 - Responsive Prestashop Theme',
    email: 'demo@posthemes.com',
    registration_number: false,
    long: false,
    lat: false,
    logo:
      '/pos_mirora/layout2/img/mirora-responsive-prestashop-theme-logo-1519658670.jpg',
    stores_icon: '/pos_mirora/layout2/img/logo_stores.png',
    favicon: '/pos_mirora/layout2/img/favicon.ico',
    favicon_update_time: '1519658670',
    address: {
      formatted: 'Mirora 2 - Responsive Prestashop Theme<br>United States',
      address1: false,
      address2: false,
      postcode: false,
      city: false,
      state: null,
      country: 'United States',
    },
    phone: false,
    fax: false,
  },
  urls: {
    base_url: 'http://demo.posthemes.com/pos_mirora/layout2/',
    current_url: 'http://demo.posthemes.com/pos_mirora/layout2/en/',
    shop_domain_url: 'http://demo.posthemes.com',
    img_ps_url: 'http://demo.posthemes.com/pos_mirora/layout2/img/',
    img_cat_url: 'http://demo.posthemes.com/pos_mirora/layout2/img/c/',
    img_lang_url: 'http://demo.posthemes.com/pos_mirora/layout2/img/l/',
    img_prod_url: 'http://demo.posthemes.com/pos_mirora/layout2/img/p/',
    img_manu_url: 'http://demo.posthemes.com/pos_mirora/layout2/img/m/',
    img_sup_url: 'http://demo.posthemes.com/pos_mirora/layout2/img/su/',
    img_ship_url: 'http://demo.posthemes.com/pos_mirora/layout2/img/s/',
    img_store_url: 'http://demo.posthemes.com/pos_mirora/layout2/img/st/',
    img_col_url: 'http://demo.posthemes.com/pos_mirora/layout2/img/co/',
    img_url:
      'http://demo.posthemes.com/pos_mirora/layout2/themes/theme_mirora2/assets/img/',
    css_url:
      'http://demo.posthemes.com/pos_mirora/layout2/themes/theme_mirora2/assets/css/',
    js_url:
      'http://demo.posthemes.com/pos_mirora/layout2/themes/theme_mirora2/assets/js/',
    pic_url: 'http://demo.posthemes.com/pos_mirora/layout2/upload/',
    pages: {
      address: 'http://demo.posthemes.com/pos_mirora/layout2/en/address',
      addresses: 'http://demo.posthemes.com/pos_mirora/layout2/en/addresses',
      authentication: 'http://demo.posthemes.com/pos_mirora/layout2/en/login',
      cart: 'http://demo.posthemes.com/pos_mirora/layout2/en/cart',
      category:
        'http://demo.posthemes.com/pos_mirora/layout2/en/index.php?controller=category',
      cms:
        'http://demo.posthemes.com/pos_mirora/layout2/en/index.php?controller=cms',
      contact: 'http://demo.posthemes.com/pos_mirora/layout2/en/contact-us',
      discount: 'http://demo.posthemes.com/pos_mirora/layout2/en/discount',
      guest_tracking:
        'http://demo.posthemes.com/pos_mirora/layout2/en/guest-tracking',
      history: 'http://demo.posthemes.com/pos_mirora/layout2/en/order-history',
      identity: 'http://demo.posthemes.com/pos_mirora/layout2/en/identity',
      index: 'http://demo.posthemes.com/pos_mirora/layout2/en/',
      my_account: 'http://demo.posthemes.com/pos_mirora/layout2/en/my-account',
      order_confirmation:
        'http://demo.posthemes.com/pos_mirora/layout2/en/order-confirmation',
      order_detail:
        'http://demo.posthemes.com/pos_mirora/layout2/en/index.php?controller=order-detail',
      order_follow:
        'http://demo.posthemes.com/pos_mirora/layout2/en/order-follow',
      order: 'http://demo.posthemes.com/pos_mirora/layout2/en/order',
      order_return:
        'http://demo.posthemes.com/pos_mirora/layout2/en/index.php?controller=order-return',
      order_slip: 'http://demo.posthemes.com/pos_mirora/layout2/en/credit-slip',
      pagenotfound:
        'http://demo.posthemes.com/pos_mirora/layout2/en/page-not-found',
      password:
        'http://demo.posthemes.com/pos_mirora/layout2/en/password-recovery',
      pdf_invoice:
        'http://demo.posthemes.com/pos_mirora/layout2/en/index.php?controller=pdf-invoice',
      pdf_order_return:
        'http://demo.posthemes.com/pos_mirora/layout2/en/index.php?controller=pdf-order-return',
      pdf_order_slip:
        'http://demo.posthemes.com/pos_mirora/layout2/en/index.php?controller=pdf-order-slip',
      prices_drop:
        'http://demo.posthemes.com/pos_mirora/layout2/en/prices-drop',
      product:
        'http://demo.posthemes.com/pos_mirora/layout2/en/index.php?controller=product',
      search: 'http://demo.posthemes.com/pos_mirora/layout2/en/search',
      sitemap: 'http://demo.posthemes.com/pos_mirora/layout2/en/sitemap',
      stores: 'http://demo.posthemes.com/pos_mirora/layout2/en/stores',
      supplier: 'http://demo.posthemes.com/pos_mirora/layout2/en/supplier',
      register:
        'http://demo.posthemes.com/pos_mirora/layout2/en/login?create_account=1',
      order_login:
        'http://demo.posthemes.com/pos_mirora/layout2/en/order?login=1',
    },
    theme_assets: '/pos_mirora/layout2/themes/theme_mirora2/assets/',
    actions: {
      logout: 'http://demo.posthemes.com/pos_mirora/layout2/en/?mylogout=',
    },
  },
  configuration: {
    display_taxes_label: false,
    low_quantity_threshold: 3,
    is_b2b: false,
    is_catalog: false,
    show_prices: true,
    opt_in: { partner: true },
    quantity_discount: { type: 'discount', label: 'Discount' },
    voucher_enabled: 0,
    return_enabled: 0,
    number_of_days_for_return: 14,
  },
  field_required: [],
  breadcrumb: {
    links: [
      {
        title: 'Home',
        url: 'http://demo.posthemes.com/pos_mirora/layout2/en/',
      },
    ],
    count: 1,
  },
  link: { protocol_link: 'http://', protocol_content: 'http://' },
  time: 1665642418,
  static_token: 'dff66f899ecf979366403714d50c0686',
  token: '300e2bd5baef04514b5dc628816e88e3',
}
var xip_base_dir = 'http://demo.posthemes.com/pos_mirora/layout2/'
