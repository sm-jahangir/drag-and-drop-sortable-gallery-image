<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Category Sortable</title>
	{{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css"> --}}
	<style>
		.dd {
			position: relative;
			display: block;
			margin: 0;
			padding: 0;
			max-width: 600px;
			list-style: none;
			font-size: 13px;
			line-height: 20px;
		}

		.dd-list {
			display: block;
			position: relative;
			margin: 0;
			padding: 0;
			list-style: none;
		}

		.dd-list .dd-list {
			padding-left: 30px;
		}

		.dd-collapsed .dd-list {
			display: none;
		}

		.dd-item,
		.dd-empty,
		.dd-placeholder {
			display: block;
			position: relative;
			margin: 0;
			padding: 0;
			min-height: 20px;
			font-size: 13px;
			line-height: 20px;
		}

		.dd-handle {
			display: block;
			height: 30px;
			margin: 5px 0;
			padding: 5px 10px;
			color: #333;
			text-decoration: none;
			font-weight: bold;
			border: 1px solid #ccc;
			background: #fafafa;
			background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
			background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
			background: linear-gradient(top, #fafafa 0%, #eee 100%);
			-webkit-border-radius: 3px;
			border-radius: 3px;
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}

		.dd-handle:hover {
			color: #2ea8e5;
			background: #fff;
		}

		.dd-item>button {
			display: block;
			position: relative;
			cursor: pointer;
			float: left;
			width: 25px;
			height: 20px;
			margin: 5px 0;
			padding: 0;
			text-indent: 100%;
			white-space: nowrap;
			overflow: hidden;
			border: 0;
			background: transparent;
			font-size: 12px;
			line-height: 1;
			text-align: center;
			font-weight: bold;
		}

		.dd-item>button:before {
			content: '+';
			display: block;
			position: absolute;
			width: 100%;
			text-align: center;
			text-indent: 0;
		}

		.dd-item>button[data-action="collapse"]:before {
			content: '-';
		}

		.dd-placeholder,
		.dd-empty {
			margin: 5px 0;
			padding: 0;
			min-height: 30px;
			background: #f2fbff;
			border: 1px dashed #b6bcbf;
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}

		.dd-empty {
			border: 1px dashed #bbb;
			min-height: 100px;
			background-color: #e5e5e5;
			background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
				-webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
			background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
				-moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
			background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
				linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
			background-size: 60px 60px;
			background-position: 0 0, 30px 30px;
		}

		.dd-dragel {
			position: absolute;
			pointer-events: none;
			z-index: 9999;
		}

		.dd-dragel>.dd-item .dd-handle {
			margin-top: 0;
		}

		.dd-dragel .dd-handle {
			-webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
			box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
		}


		.nestable-lists {
			display: block;
			clear: both;
			padding: 30px 0;
			width: 100%;
			border: 0;
			border-top: 2px solid #ddd;
			border-bottom: 2px solid #ddd;
		}

		#nestable-menu {
			padding: 0;
			margin: 20px 0;
		}

		#nestable-output,
		#nestable2-output {
			width: 100%;
			height: 7em;
			font-size: 0.75em;
			line-height: 1.333333em;
			font-family: Consolas, monospace;
			padding: 5px;
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}

		#nestable2 .dd-handle {
			color: #fff;
			border: 1px solid #999;
			background: #bbb;
			background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
			background: -moz-linear-gradient(top, #bbb 0%, #999 100%);
			background: linear-gradient(top, #bbb 0%, #999 100%);
		}

		#nestable2 .dd-handle:hover {
			background: #bbb;
		}

		#nestable2 .dd-item>button:before {
			color: #fff;
		}

		@media only screen and (min-width: 700px) {

			.dd {
				float: left;
				width: 48%;
			}

			.dd+.dd {
				margin-left: 2%;
			}

		}

		.dd-hover>.dd-handle {
			background: #2ea8e5 !important;
		}

		.dd3-content {
			display: block;
			height: 30px;
			margin: 5px 0;
			padding: 5px 10px 5px 40px;
			color: #333;
			text-decoration: none;
			font-weight: bold;
			border: 1px solid #ccc;
			background: #fafafa;
			background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
			background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
			background: linear-gradient(top, #fafafa 0%, #eee 100%);
			-webkit-border-radius: 3px;
			border-radius: 3px;
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}

		.dd3-content:hover {
			color: #2ea8e5;
			background: #fff;
		}

		.dd-dragel>.dd3-item>.dd3-content {
			margin: 0;
		}

		.dd3-item>button {
			margin-left: 30px;
		}

		.dd3-handle {
			position: absolute;
			margin: 0;
			left: 0;
			top: 0;
			cursor: pointer;
			width: 30px;
			text-indent: 100%;
			white-space: nowrap;
			overflow: hidden;
			border: 1px solid #aaa;
			background: #ddd;
			background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
			background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
			background: linear-gradient(top, #ddd 0%, #bbb 100%);
			border-top-right-radius: 0;
			border-bottom-right-radius: 0;
		}

		.dd3-handle:before {
			content: '≡';
			display: block;
			position: absolute;
			left: 0;
			top: 3px;
			width: 100%;
			text-align: center;
			text-indent: 0;
			color: #fff;
			font-size: 20px;
			font-weight: normal;
		}

		.dd3-handle:hover {
			background: #ddd;
		}
	</style>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap');

		body {
			font-family: 'Roboto', sans-serif;
		}
	</style>
</head>

<body style="width: 80%; margin: 20px auto">

	<div class="cf nestable-lists">

		<p><strong>Draggable Handles</strong></p>

		<p>If you're clever with your CSS and markup this can be achieved without any JavaScript changes.</p>

		<div class="dd" id="nestable">
			<ol class="dd-list">

				@foreach ($categories as $category)
					<li class="dd-item dd3-item" data-id="{{ $category->id }}">
						<div class="dd-handle dd3-handle"></div>
						<div class="dd3-content">{{ $category->title }}</div>
						@if ($category->childs->count() > 0)
							<ol class="dd-list">
								@foreach ($category->childs as $subCategory)
									<li class="dd-item dd3-item" data-id="{{ $subCategory->id }}">
										<div class="dd-handle dd3-handle"></div>
										<div class="dd3-content">{{ $subCategory->title }}</div>
										@if ($subCategory->childs->count() > 0)
											@foreach ($subCategory->childs as $childCategory)
												<ol class="dd-list">
													<li class="dd-item dd3-item" data-id="{{ $childCategory->id }}">
														<div class="dd-handle dd3-handle"></div>
														<div class="dd3-content">{{ $childCategory->title }}</div>
													</li>
												</ol>
											@endforeach
										@endif
									</li>
								@endforeach
							</ol>
						@endif
					</li>
				@endforeach
			</ol>
		</div>

		<textarea id="nestable-output"></textarea>

	</div>

	<p class="small">Copyright &copy; <a href="http://dbushell.com/" target="_blank" rel="nofollow">David Bushell</a> |
		Made for <a href="http://www.browserlondon.com/" rel="nofollow" target="_blank">Browser</a></p>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
	<script>
	 $(document).ready(function() {
	  var updateOutput = function(e) {
	   var list = e.length ? e : $(e.target),
	    output = list.data("output");
	   if (window.JSON) {
	    output.val(window.JSON.stringify(list.nestable("serialize"))); //, null, 2));
	    console.log(JSON.stringify(list.nestable("serialize")))
	   } else {
	    output.val("JSON browser support required for this demo.");
	   }
	  };

	  // activate Nestable for list 1
	  $("#nestable")
	   .nestable({
	    group: 1,
	   })
	   .on("change", updateOutput);

	  // output initial serialised data
	  updateOutput($("#nestable").data("output", $("#nestable-output")));

	  $("#nestable-menu").on("click", function(e) {
	   var target = $(e.target),
	    action = target.data("action");
	   if (action === "expand-all") {
	    $(".dd").nestable("expandAll");
	   }
	   if (action === "collapse-all") {
	    $(".dd").nestable("collapseAll");
	   }
	  });
	 })
	</script>
</body>

</html>
