
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Title -->
	<title>Get Started</title>
    <!-- Favicon icon -->
    {{-- <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png"> --}}
    <!-- Form step -->
    <link href="{{ asset('dashboard_assets/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link href="{{ asset('dashboard_assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
  <link href="{{ asset('dashboard_assets/css/style.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">
</head>

<body>
 <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">












        <!--**********************************
            Content body start
        ***********************************-->
        <div class="mt-5 pt-5 ">
            <div class="container-fluid">

                <!-- row -->
                <div class="row">
                    <div class="col-xl-8 col-xxl-8 m-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Get Started </h4>
                            </div>

                            <div class="card-body">
                                @if($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                                @endforeach
                                @endif
								<div id="smartwizard" class="form-wizard order-create">
									<ul class="nav nav-wizard">
										<li class="disabled"><a class="nav-link" href="#wizard_one">
											<span>1</span>
										</a></li>
										<li class="disabled"><a class="nav-link" href="#wizard_two">
											<span>2</span>
										</a></li>
										<li class="disabled"><a class="nav-link" href="#wizard_three">
											<span>3</span>
										</a></li>
										{{-- <li><a class="nav-link" href="#wizard_four">
											<span>4</span>
										</a></li> --}}
									</ul>
									<div class="tab-content">
                                        <form id="wizard_form" action="{{ route('welcome.store') }}" method="post" enctype="multipart/form-data">

                                            @csrf
										<div id="wizard_one" class="tab-pane p-4" role="tabpanel">
											<div class="row">
												<div class="col-lg-12 mb-2">
													<div class="form-group">
														<label class="form-label">Website Name<span class="required">*</span></label>
														<input type="text" name="web_name" class="form-control @error('web_name') is-invalid @enderror" placeholder="Synex Digital" required id="name" value="{{ old('web_name') }}">


													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="form-group">
														<label class="form-label">Website Logo</label>
														<input type="file" name="web_logo" class="form-control" placeholder=""  >
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="form-group">
														<label class="form-label">Website Favicon</label>
														<input type="file" name="web_fav" class="form-control" placeholder="" >
													</div>
												</div>

											</div>
										</div>
										<div id="wizard_two" class="tab-pane p-4" role="tabpanel">
											<div class="row">
												<div class="col-lg-6 mb-2">
													<div class="form-group">
														<label class="form-label">Domain Name<span class="required">*</span></label>
														<input type="text" name="domain" class="form-control @error('domain') is-invalid @enderror" value="{{ old('domain') }}"   placeholder="www.example.com" required >


													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="form-group">
														<label class="form-label">Email Address</label>
														<input type="email" class="form-control" name="email"  placeholder="example@example.com" >
													</div>
												</div>
												<div class="col-lg-12 mb-2">
													<div class="form-group">
														<label class="form-label">Address</label>
														<textarea name="address" id="" cols="30" rows="5" class="form-control" placeholder="Your Website Address" ></textarea>
													</div>
												</div>

											</div>
										</div>
										<div id="wizard_three" class="tab-pane p-4" role="tabpanel">
											<div class="row align-items-center">
                                                <div class="col-lg-12 mb-2 ">
													<div class="form-group text-center">
														<label class="form-label ">Set Your Admin Credentials  </label>

													</div>
												</div>
                                                <div class="col-lg-12 mb-2">
													<div class="form-group">
														<label class="form-label">Email<span class="required">*</span>  </label>
														<input name="adminEmail" type="email" class="form-control @error('email') is-invalid

                                                        @enderror"  placeholder="example@example.com" autocomplete="username">
													</div>
												</div>
												<div class="col-lg-12 mb-2">
													<div class="form-group">
														<label class="form-label">Password <span class="required">*</span></label>
                                                        <input type="password" class="form-control @error('password') is-invalid

                                                        @enderror" name="adminPassword" placeholder="********" autocomplete="new-password">
													</div>
												</div>

											</div>

										</div>
                                    </form>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer ps-0"  >
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="http://synexdigital.com/" target="_blank">Synex Digital</a> 2024</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('dashboard_assets/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('dashboard_assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/custom.min.js') }}"></script>
	<script src="{{ asset('dashboard_assets/js/deznav-init.js') }}"></script>




    <script src="{{ asset('dashboard_assets/vendor/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- Form validate init -->
    <script src="{{ asset('dashboard_assets/js/plugins-init/jquery.validate-init.js') }}"></script>



   <!-- Form Steps -->
	<script src="{{ asset('dashboard_assets/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js') }}"></script>

	<script>
		$(document).ready(function(){
			// SmartWizard initialize
			$('#smartwizard').smartWizard();
		});
	</script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#smartwizard').on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                // Check if the step leaving is the second one (since stepNumber is zero-based, 2 means third step)
                // alert(stepNumber);
                if (stepNumber == 1 && stepDirection === 'forward') {
                    // Change the Next button to Done
                    $(".sw-btn-next").text('Done');

                }
                if (stepNumber == 2 && stepDirection === 'backward') {
                    // Change back to Next if user goes back
                    $(".sw-btn-next").text('Next');
                }
            });

            $('#smartwizard').on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
                // On reaching the third step directly
                if (stepNumber == 1 && stepDirection === 'forward') {
                    $(".sw-btn-next").text('Done');
                } else {
                    $(".sw-btn-next").text('Next'); // Ensure it says 'Next' on other steps
                }
            });
        }, 100); // Delay script execution by 100 milliseconds
        let x = false;
        if($('#name').val() == ''){
            $('.sw-btn-next').addClass('disabled');
        }
        $('#name').on('input', function() {
            let val = $(this).val();
            if (val == '') {
                if(!$('.sw-btn-next').hasClass('disabled')){
                    $('.sw-btn-next').addClass('disabled');
                }
            } else {
                $('.sw-btn-next').removeClass('disabled');
            }
        })
        $('.sw-btn-next').on('click', function() {

            if(x == true){
                $('#wizard_form').submit();
            }
            let text = $(this).text();
            if (text === 'Done') {
                $(this).removeClass('disabled');
                x = true;
            }


        });


    });

    </script>


</body>

</html>
