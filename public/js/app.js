Vue.component("onearticle", {
    template: "#article-template",
    props: {
        index: Number,
        id: String,
        slug : String,
        title: String,
        excerpt: String,
        content: String,
        tags: [],
        published: Boolean,
    },
    methods: {
        loadWriter(e, slug, index) {
            e.preventDefault(); 
            const artProps = app.$children[0].$children[index]._props;
            app.$children[1]._data.content = artProps.content;
            app.$children[1]._data.title = artProps.title;
            app.$children[1]._data.tags = artProps.tags;
            app.$children[1]._data.slug = artProps.slug;
            app.$children[1]._data.id = artProps.id;
            console.log("id: ", artProps.id);
            return false;
        },
        toggleStatus(e, id) {
            e.preventDefault();
            e.stopImmediatePropagation();
            toggleStatus(id)
                .then(console.log)
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
            app.$children[1]._data.slug = "";
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
        publish(e, slug) {
            publishArticle(slug, this._data)
                .then((msg) => {
                    getArticles();
                    popup(app, msg);
                })
                .catch((msg) => {
                    popup(app, msg);
                })
        },
        deleteArticle(e, slug) {
            deleteArticleAsync(slug)
                .then((msg) => {
                    app.articleViewVisible = true;
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
            slug: "",
            title: "",
            id: "",
            content: "",
            published: false,
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


