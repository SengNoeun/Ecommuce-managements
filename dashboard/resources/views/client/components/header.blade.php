
  <div class="header-desk header-desk_type_1">
        <div class="logo">
          <a href="{{route("client.home.index")}}">
           <h1>WE SKIN</h1>
          </a>
        </div>
        
        <nav class="navigation">
          <ul class="navigation__list list-unstyled d-flex">
            <li class="navigation__item">
              <a href="{{route('client.home.index')}}" class="navigation__link">HOME</a>
            </li>
             <li class="navigation__item">
              <a href="{{route('client.shop.index')}}" class="navigation__link">SHOP</a>
            </li>
             <li class="navigation__item">
              <a href="{{route('client.cart.index')}}" class="navigation__link">CARD</a>
            </li>
             <li class="navigation__item">
              <a href="index.html" class="navigation__link">ABOUT</a>
            </li>
            <li class="navigation__item">
              <a href="index.html" class="navigation__link">CONTACT</a>
            </li>
          </ul>
          
        </nav>

        <div class="header-tools d-flex align-items-center">
          <div class="header-tools__item hover-container">
            <div class="js-hover__open position-relative">
              <a class="js-search-popup search-field__actor" href="#">
                <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_search" />
                </svg>
                <i class="btn-icon btn-close-lg"></i>
              </a>
            </div>

            
          </div>

          <div class="header-tools__item hover-container">
            <a href="{{route('client.login.index')}}" class="header-tools__item">
              <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_user" />
              </svg>
            </a>
          </div>

          <a href="wishlist.html" class="header-tools__item">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_heart" />
            </svg>
          </a>

          <a href="{{route('client.cart.index')}}" class="header-tools__item header-tools__cart">
            <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_cart" />
            </svg>
            <span class="cart-amount d-block position-absolute js-cart-items-count text-red-600">6</span>
                
          </a>
        </div>
      </div>