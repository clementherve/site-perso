
let $ = (e) => document.querySelector(e);

// load articles
let getArticles = () => {
    fetch("/articles/json/")
    .then(resp => resp.json())
    .then((resp) => {
        app.articles = []
        for(let i=0; i<resp.length; i++) {
            resp[i]["index"] = i;
            app.articles.push(resp[i]);
        }
    })
    .catch(err => {
        alert(err);
    })
}
getArticles();



// toggle article publishing status
let toggleStatus = (slug) => {
    return fetch("/article/visibility/toggle/" + slug)
        .then(getArticles);
}

let saveArticle = (id, raw) => {
    console.log("saveArticle", id, raw);
    const body = prepare(raw);
    console.log("body", body);
    if (body == false) {
        return new Promise((resolve, reject) => {});
    }

    console.log("df");

    return fetch("/article/update/", {
        method: "post",
        headers: {
            'Content-Type':'application/x-www-form-urlencoded',
        },
        body: body
    }).then(resp => resp.text());
}

let publishArticle = (id, raw) => {
    const body = prepare(raw);
    if (body == false) {
        return new Promise((resolve, reject) => {});
    }
    return fetch("/article/publish/" + id).then(resp => resp.text());
}

let deleteArticleAsync = (id) => {
    return fetch("/article/delete/" + id, {
        method: "delete",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    }).then(resp => resp.text());
}


let popup = (app, msg) => {
    app.popupVisible = true;
    app.popupMessage = msg;
    setTimeout(() => {
        app.popupVisible = false;
    }, 2000);
}


let prepare = (raw) => {
    if (raw.title === "" || raw.content === "" || raw.tags === "" || raw.slug === "") {
        return false;
    }

    return "title="+raw.title +
        "&content=" +raw.content +
        "&tags=" + raw.tags +
        "&slug=" + raw.slug +
        "&id=" + raw.id +
        "&published=" + raw.status
}