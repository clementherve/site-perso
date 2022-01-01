


-- create database blog;
drop table if exists hastag;
drop table if exists tags;
drop table if exists articles;

create table articles (
    id serial primary key,
    slug text unique not null,
    title text not null,
    content text not null,
    "date" timestamp not null default now(),
    published boolean
);

create table tags (
    articleslug text,
    tagname text,
    primary key (articleslug, tagname),
    foreign key(articleslug) references articles(slug) on delete cascade on update cascade
);