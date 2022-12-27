<li class="menu-item-has-children">
    <a href="#">Sample 1</a>
    <ul class="sub-menu">
        <li><a href="#">Sample 2</a></li>
        @foreach($menu->childs as $subMenu)
            <a href="#">Sample 1</a>
            <ul class="sub-menu">
                <li><a href="#">Sample 2</a></li>
                <li><a href="#">Sample 3</a></li>
                <li><a href="#">Sample 4</a></li>
                <li class="menu-item-has-children">
                    <a href="#">Sample 1</a>
                    <ul class="sub-menu">
                        <li><a href="#">Sample 2</a></li>
                        <li><a href="#">Sample 3</a></li>
                        <li><a href="#">Sample 4</a></li>
                        <li><a href="#">Sample 5</a></li>
                        <li><a href="#">Sample 6</a></li>
                    </ul>
                </li>
                <li><a href="#">Sample 6</a></li>
            </ul>
        @endforeach
    </ul>
</li>