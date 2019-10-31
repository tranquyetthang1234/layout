<head>
	<meta charset="utf-8" />
	<title><?=ucfirst($title)?> | Thời Đại Land</title>
	<meta name="description" content="Page with empty content">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php do_action("meta_head", $title)?>
	<!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

	<script>
		WebFont.load({
			google: {
				"families": ["Quicksand:300,400,500,600,700"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!--end::Fonts -->

	<!--begin::Page Vendors Styles(used by this page) -->

	<!--end::Page Vendors Styles -->

	<!--begin:: Global Mandatory Vendors -->
	<link href="<?=assets_url()?>/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />

	<!--end:: Global Mandatory Vendors -->

	<!--begin:: Global Optional Vendors -->
	<link href="<?=assets_url()?>/vendors/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/vendors/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/vendors/custom/vendors/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/vendors/custom/vendors/fontawesome5/css/all.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/vendors/custom/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/vendors/general/toastr/toastr.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/vendors/general/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/vendors/general/datatables/datatables.bundle.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />

	<!--end:: Global Optional Vendors -->

	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="<?=assets_url()?>/base/style.bundle.css" rel="stylesheet" type="text/css" />

	<!--end::Global Theme Styles -->

	<!--begin::Layout Skins(used by all pages) -->
	<link href="<?=assets_url()?>/skins/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/skins/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/skins/aside/dark.css" rel="stylesheet" type="text/css" />

	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="<?=assets_url()?>/media/company-logos/favicon.ico" />

	<link href="<?=assets_url()?>/alertifyjs/css/alertify.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/vendors/custom/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?=assets_url()?>/app/custom/admin.min.css" rel="stylesheet" type="text/css" />
	<?php load_style();?>
	<script>
		var data = {};
	</script>
</head>
