<nav class="menu-main">
    <ul class="menu-main__list">
        <li class="menu-main__item">
            <a href="#" class="menu-main__link">
                @lang('menu.news')
            </a>
        </li>
        <li class="menu-main__item">
            <a href="#" class="menu-main__link">
                @lang('menu.events')
            </a>
        </li>
        <li class="menu-main__item">
            <a href="#" class="menu-main__link">
                @lang('menu.companies')
            </a>
        </li>
        <li class="menu-main__item">
            <a href="#" class="menu-main__link">
                @lang('menu.blogs')
            </a>
        </li>
        <li class="menu-main__item">
            <a href="#" class="menu-main__link">
                @lang('menu.services')
            </a>
        </li>
        <li class="menu-main__item">
            <a href="{{ route('users.list') }}" class="menu-main__link">
                @lang('menu.users')
            </a>
        </li>
    </ul>
</nav>
<button id="button-menu" class="button-menu">
    <span class="button-menu__line"></span>
    <span class="button-menu__line"></span>
    <span class="button-menu__line"></span>
</button>

@push('scripts')
    <script>
        $(document).ready(function(){
            let open = function() {
                $('.menu-main').css({'height': $(window).outerHeight() + 100});
                $('body').addClass('menu-open');
            };
            let close = function () {
                $('body').removeClass('menu-open');
            };
            $('.button-menu').click(function () {
                if ($('body').hasClass('menu-open')) {
                    close();
                } else {
                    open();
                }
            });
        });
    </script>
@endpush