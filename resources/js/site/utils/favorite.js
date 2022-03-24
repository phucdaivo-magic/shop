

export default {
  getFavorite() {
    const favoriteLocal = localStorage.getItem("favorite") || "{}";
    return JSON.parse(favoriteLocal);
  },

  pushFavorite(id) {
    const favoriteLocal = this.getFavorite();
    favoriteLocal[id] = id;
    this.setFavorite(favoriteLocal);
  },

  removeFavorite(id) {
    const favoriteLocal = this.getFavorite();
    delete favoriteLocal[id];
    this.setFavorite(favoriteLocal);
  },

  setFavorite(favoriteLocal) {
    localStorage.setItem("favorite", JSON.stringify(favoriteLocal));
  },

  getListFavorite() {
    const favoriteLocal = this.getFavorite();
    return Object.keys(favoriteLocal);
  },

  getFavoriteNum() {
    return Object.keys(this.getFavorite()).length;
  }
}