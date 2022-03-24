

export default {
  getCart() {
    let cartLocal = localStorage.getItem("cart") || "{}";
    return JSON.parse(cartLocal);
  },

  pushCart(key, mount) {
    const cartLocal = this.getCart();
    cartLocal[key] = (cartLocal[key] ? cartLocal[key] : 0) + mount;
    this.setCart(cartLocal);
  },

  setCart(cartLocal) {
    localStorage.setItem("cart", JSON.stringify(cartLocal));
  },

  getCartNum() {
    return Object.keys(this.getCart()).length;
  }
}