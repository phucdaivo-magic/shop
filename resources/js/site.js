import Vue from "vue";
import Cart from "./site/page/Cart";
import Payment from "./site/page/Payment";
import Vue2Filters from 'vue2-filters';
import VeeValidate from 'vee-validate';
import Product from "./site/page/product/component/Product"
import CardProduct from "./site/components/CardProduct"
import ProductCategory from "./site/components/ProductCategory"
import ProductHome from "./site/components/ProductHome"
import HeaderIcon from "./site/components/HeaderIcon"
import InfiniteLoading from "vue-infinite-loading";
import VueCarousel from 'vue-carousel';
import cart from "./site/utils/cart";


// require('../sass/site.scss')

Vue.use(VueCarousel);
Vue.use(Vue2Filters);
Vue.use(VeeValidate);
Vue.component('vue-infinite-loading', InfiniteLoading);
Vue.component('card-product', CardProduct)
Vue.component('product', Product)
Vue.component('cart', Cart)
Vue.component('payment', Payment)
Vue.component('product-category', ProductCategory)
Vue.component('product-home', ProductHome)
Vue.component('header-icon', HeaderIcon)

// document.addEventListener('DOMContentLoaded', () => {
//   if (document.getElementById('app')) {
//     new Vue({
//       el: '#app',
//       render: h => h(Cart),
//     }).$mount();
//   }
// });

// document.addEventListener('DOMContentLoaded', () => {
//   if (document.getElementById('payment')) {
//     new Vue({
//       el: '#payment',
//       render: h => h(Payment),
//     }).$mount();
//   }
// });

document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('app')) {
    new Vue({
      el: '#app',
      data() {
        return {
          cart: cart.getCartNum(),
          favorite: 0
        }
      },
      created() {
        console.log(cart.getCartNum());
      },
      methods: {
        updateCart() {
          this.cart = cart.getCartNum();
        }
      }
      // render: h => h(Payment),
    });
  }
});

$('li.dropdown').hover(
  function(){
      $(this).addClass('open').find('ul').stop(true,true).hide().slideDown('fast');
  },
  function(){
      $(this).removeClass('open').find('ul').stop(true,true).slideUp('fast');
  }
);
// $('li.dropdown li').unbind('mouseover').unbind('mouseout');
