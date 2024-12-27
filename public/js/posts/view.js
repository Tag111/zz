/*
* Post view page
 */
"use strict";
/* global app, postVars, Post, CommentsPaginator, PostsPaginator */

$(function () {
    // Initing button save
    $('.post-create-button').on('click',function () {
        Post.create();
    });

    Post.setActivePage('post');
    Post.initPostsMediaModule();
    // Initing read more/less toggler based on clip property
    PostsPaginator.initDescriptionTogglers();
    Post.initGalleryModule('.post-box');
    Post.initGalleryModule('.recent-media');

    CommentsPaginator.init(app.baseUrl+'/posts/comments','.post-comments-wrapper');
    Post.showPostComments(postVars.post_id,9);

    $('.post-comments').removeClass('d-none');

});

$(window).scroll(function(){
    var top = $(window).scrollTop();
    if ($(".main-wrapper").offset().top < top) {
        $(".profile-widgets-area").addClass("sticky-profile-widgets");
    } else {
        $(".profile-widgets-area").removeClass("sticky-profile-widgets");
    }
});
