<aside id="left-panel" class="left-panel">
	<nav class="navbar navbar-expand-sm navbar-default">
		<div id="main-menu" class="main-menu collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li>
					<a href="{{ url('/admin_panel') }}"><i class="menu-icon fa fa-laptop"></i>Главная</a>
				</li>
				<li>
					<a href="{{ url('/admin_panel/users') }}"> <i class="menu-icon ti-user"></i>Пользователи</a>
				</li>
                <li>
                    <a href="{{ url('/admin_panel/groups') }}"> <i class="menu-icon ti fa fa-group"></i>Группы</a>
                </li>
                <li>
                    <a href="{{ url('/admin_panel/tests') }}"> <i class="menu-icon ti-list"></i>Тесты</a>
                </li>
			</ul>
		</div>
	</nav>
</aside>