@extends('template.tpl_logReg')

@section('title') Register @stop


@section('content')

<div id="wrap_registration">
	<header>
		<a href="{{ URL::to('/') }}">
			<img src="{{ URL::asset('img/logo.png') }}" alt="learnapolis">
		</a>
	</header>

	<h2>Registration</h2>

	<div class="wrap-content container">
		<form role="form" method="POST" action="{{ URL::route('register-post') }}">

			<div class="form-group">
				<label>E-mail Address</label>
				<input type="email" class="form-control"
					   name="email"{{ (Input::old('email')) ? ' value="'. Input::old('email') .'"' : '' }}
					   placeholder="e.g., your@email.com"
					   required autofocus>
				@if ( $errors->has('email') )
					<span class="text-danger">{{ $errors->first('email') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label>First Name</label>
				<input type="text" class="form-control"
					   name="firstname"{{ (Input::old('firstname')) ? ' value="'. Input::old('firstname') .'"' : '' }}
					   required>
				@if ( $errors->has('firstname') )
					<span class="text-danger">{{ $errors->first('firstname') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label>Last Name</label>
				<input type="text" class="form-control"
					   name="lastname"{{ (Input::old('lastname')) ? ' value="'. Input::old('lastname') .'"' : '' }}
					   required>
				@if ( $errors->has('lastname') )
					<span class="text-danger">{{ $errors->first('lastname') }}</span>
				@endif
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password" placeholder="e.g., 6-12 characters"
				required>
				@if ( $errors->has('password') )
					<span class="text-danger">{{ $errors->first('password') }}</span>
				@endif
			</div>

			<div class="checkbox">
				<label>
					<input type="checkbox" name="cb_tos" required> <small>You agree to our <a href="#modal_tos" data-toggle="modal">Terms of Service</a> and our <a href="#modal_privacy" data-toggle="modal">Privacy Policy</a></small>
				</label>
				@if ( $errors->has('cb_tos') )
					<span class="text-danger">{{ $errors->first('cb_tos') }}</span>
				@endif
			</div>

			<div class="row">
				<div class="col-md-5"><small>Do you have an account already? <a href="{{ URL::to('login') }}">Login</a></small></div>
					<div class="col-md-4 col-md-offset-3">
					<button type="submit" class="pull-right btn btn-primary">Register</button>
				</div>
			</div>


		</form>
	</div>


    {{-- TOS --}}
    <div class="modal fade" id="modal_tos" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Terms of Service</h4>
          </div>
          <div class="modal-body">
			<h4>1. Terms</h4>
			<p>
				By accessing this web site, you are agreeing to be bound by these 
				web site Terms and Conditions of Use, all applicable laws and regulations, 
				and agree that you are responsible for compliance with any applicable local 
				laws. If you do not agree with any of these terms, you are prohibited from 
				using or accessing this site. The materials contained in this web site are 
				protected by applicable copyright and trade mark law.
			</p>

			<h4>2. Use License</h4>
			<ol type="a">
				<li>
					Permission is granted to temporarily download one copy of the materials 
					(information or software) on Learnapolis's web site for personal, 
					non-commercial transitory viewing only. This is the grant of a license, 
					not a transfer of title, and under this license you may not:
					
					<ol type="i">
						<li>modify or copy the materials;</li>
						<li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
						<li>attempt to decompile or reverse engineer any software contained on Learnapolis's web site;</li>
						<li>remove any copyright or other proprietary notations from the materials; or</li>
						<li>transfer the materials to another person or "mirror" the materials on any other server.</li>
					</ol>
				</li>
				<li>
					This license shall automatically terminate if you violate any of these restrictions and may be terminated by Learnapolis at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.
				</li>
			</ol>

			<h4>3. Disclaimer</h4>
			<ol type="a">
				<li>
					The materials on Learnapolis's web site are provided "as is". Learnapolis makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, Learnapolis does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.
				</li>
			</ol>

			<h4>4. Limitations</h4>
			<p>In no event shall Learnapolis or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on Learnapolis's Internet site, even if Learnapolis or a Learnapolis authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</p>
			
			<h4>5. Revisions and Errata</h4>
			<p>The materials appearing on Learnapolis's web site could include technical, typographical, or photographic errors. Learnapolis does not warrant that any of the materials on its web site are accurate, complete, or current. Learnapolis may make changes to the materials contained on its web site at any time without notice. Learnapolis does not, however, make any commitment to update the materials.</p>

			<h4>6. Links</h4>
			<p>Learnapolis has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Learnapolis of the site. Use of any such linked web site is at the user's own risk.</p>

			<h4>7. Site Terms of Use Modifications</h4>
			<p>Learnapolis may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.</p>

			<h4>8. Governing Law</h4>
			<p>Any claim relating to Learnapolis's web site shall be governed by the laws of the State of Denmark without regard to its conflict of law provisions.</p>
			<p>General Terms and Conditions applicable to Use of a Web Site.</p>

          </div>
          <!-- <div class="modal-footer"></div> -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->	

    {{-- Privacy Policy --}}
    <div class="modal fade" id="modal_privacy" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Privacy Policy</h4>
          </div>
          <div class="modal-body">

			<p>Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy policy.</p>
			<ul>
				<li>Before or at the time of collecting personal information, we will identify the purposes for which information is being collected.</li>
				<li>We will collect and use of personal information solely with the objective of fulfilling those purposes specified by us and for other compatible purposes, unless we obtain the consent of the individual concerned or as required by law.</li>
				<li>We will only retain personal information as long as necessary for the fulfillment of those purposes.</li>
				<li>We will collect personal information by lawful and fair means and, where appropriate, with the knowledge or consent of the individual concerned.</li>
				<li>Personal data should be relevant to the purposes for which it is to be used, and, to the extent necessary for those purposes, should be accurate, complete, and up-to-date.</li>
				<li>We will protect personal information by reasonable security safeguards against loss or theft, as well as unauthorized access, disclosure, copying, use or modification.</li>
				<li>We will make readily available to customers information about our policies and practices relating to the management of personal information.</li>
			</ul>
			<p>We are committed to conducting our business in accordance with these principles in order to ensure that the confidentiality of personal information is protected and maintained.</p>					

          </div>
          <!-- <div class="modal-footer"></div> -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->	

</div>

@stop