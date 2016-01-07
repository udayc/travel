<div class="row">
	<div class="col-sm-12">
		<!-- start: RESPONSIVE ICONS BUTTONS PANEL -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-external-link-square"></i>
				 Project statistics Of {{ $user->name }}
			</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-sm-3">
						<button class="btn btn-icon btn-block">
							<i class="fa fa-calendar"></i>
							Projects Posted <span class="badge badge-success"> {{ $authUserStat['my_posted_projects']}}</span>
						</button>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-icon btn-block">
							<i class="fa fa-heart-o"></i>
							Projects Backed <span class="badge badge-danger"> {{ $authUserStat['my_backed_projects']}} </span>
						</button>
					</div>
					<div class="col-sm-2">
						<button class="btn btn-icon btn-block">
							<i class="fa fa-thumbs-up"></i>
							Project Likes <span class="badge badge-warning"> {{ $authUserStat['my_likes_projects']}} </span>
						</button>
					</div>
					<div class="col-sm-4">
						<button class="btn btn-icon btn-block">
							<i class="fa fa-exclamation-triangle"></i>
							Following Projects <span class="badge badge-success"> {{ $authUserStat['my_following_projects']}} </span>
						</button>
					</div>
				</div>

			</div>
		</div>
		<!-- end: RESPONSIVE ICONS BUTTONS PANEL -->
	</div>
</div>	