<li class=" menu-item-has-children ">
    <ul class="sub-menu">
        @if(count($menu->childs))
            @include('website.menu.sub-menu',['childs' => $menu->childs])
        @endif
    </ul>
</li>