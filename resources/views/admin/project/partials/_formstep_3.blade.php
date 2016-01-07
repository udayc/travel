@if(Session::has('last_insert_id'))
{!! Form::hidden('_secret_key_', $skey ) !!}
@endif

	<div id="wizard" class="swMain">
	<ul>
	<li>
	<a href="#step-1" class="{{ $class }}" isdone="{{ $isDone }}" rel="{{ $rel }}">
	<div class="stepNumber">1</div>
	<span class="stepDesc">Basic
	</span>
	</a>
	</li>
	<li>
	<a href="#step-2" class="{{ $class }}" isdone="{{ $isDone }}" rel="{{ $rel }}" >
	<div class="stepNumber">
	2
	</div>
	<span class="stepDesc">Project Details
    </span>
	</a>
	</li>

	<li>
	<a href="#step-3" class="{{ $class }}" isdone="{{ $isDone }}" rel="{{ $rel }}" >
	<div class="stepNumber">
	3
	</div>
	<span class="stepDesc"> Rewards
	</span>
	</a>
	</li>

	<li>
	<a href="#step-4" class="disabled" isdone="0" rel="{{ $rel }}" >
	<div class="stepNumber">
	4
	</div>
	<span class="stepDesc"> Payout
	</span>
	</a>
	</li>												

	<li>
	<a href="#step-5" class="disabled" isdone="0" rel="{{ $rel }}" >
	<div class="stepNumber">	5	</div>
	<span class="stepDesc"> Confirmation
	</span>
	</a>
	</li>
	</ul>


	</div>