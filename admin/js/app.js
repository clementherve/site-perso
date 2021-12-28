Vue.component("onearticle", {
    template: "#article-template",
    props: {
        index: Number,
        id : String,
        title: String,
        excerpt: String,
        content: String,
        tags: String,
        status: Boolean,
    },
    methods: {
        loadWriter(e, id, index) {
            e.preventDefault(); 
            const artProps = app.$children[0].$children[index]._props;
            app.$children[1]._data.content = artProps.content;
            app.$children[1]._data.title = artProps.title;
            app.$children[1]._data.tags = artProps.tags;
            app.$children[1]._data.id = artProps.id;
            return false;
        },
        toggleStatus(e, id) {
            e.preventDefault();
            e.stopImmediatePropagation();
            toggleStatus(id)
                .then(resp => resp.text())
                .then((msg) => {
                    getArticles();
                    popup(app, msg);
                })
                .catch((msg) => {
                    popup(app, msg);
                })
            return false;
        },
    }
});



Vue.component("articles", {
    template: "#articles-template",
    props: {
        articles: Array,
    },
    methods: {
        hide() {
            app.articleViewVisible = false;
        },
        createNewArticle() {
            app.$children[1]._data.content = "";
            app.$children[1]._data.title = "";
            app.$children[1]._data.tags = "";
            app.$children[1]._data.id = "";
            app.articleViewVisible = false;
        }
    }
})


Vue.component("writer", {
    template: "#writer-template",
    methods: {
        goBack(e, id) {
            app.articleViewVisible = true;
            saveArticle(id, this._data)
                .then((msg) => {
                    getArticles();
                    popup(app, msg);
                })
                .catch((msg) => {
                    popup(app, msg);
                })
        },
        save(e, id) {
            saveArticle(id, this._data)
                .then((msg) => {
                    getArticles();
                    popup(app, msg);
                })
                .catch((msg) => {
                    popup(app, msg);
                })
        },
        publish(e, id) {
            publishArticle(id, this._data)
                .then((msg) => {
                    getArticles();
                    popup(app, msg);
                })
                .catch((msg) => {
                    popup(app, msg);
                })
        },
        deleteArticle(e, id) {
            deleteArticleAsync(id)
                .then((msg) => {
                    getArticles();
                    popup(app, msg);
                })
                .catch((msg) => {
                    popup(app);
                })
        }
    },
    data() {
        return {
            id: "",
            title: "",
            content: "",
            status: false,
            tags: "",
        }
    }

})


Vue.component("popup", {
    template: "#popup-template",
    methods: {
        toggleStatus(e) {
            app.popupVisible = !app.popupVisible;
        }
    },
    data() {
        return {
            message: app.popupMessage
        }
    }
})

let app = new Vue({
    el: "#app",
    data: {
        popupVisible: false,
        popupMessage: "",
        articleViewVisible: true,
        articles: []
    }
})


