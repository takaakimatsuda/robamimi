<template>
	<button class="fas fa-thumbs-up mb-2" @click="onLikeClick(clickedComment)" :class="{ 'like-animation': clickedComment.liked_by_user }"> {{count}}</button>
</template>
<script>
    export default {
	    props: {
		    comment: Object,
		    likes_count: Number,
	    },
        data() {
            return {
				clickedComment: this.comment,
				count: this.likes_count,
			};
        },
        methods: {
			onLikeClick(clickedComment) {
				if(clickedComment.liked_by_user) {
					this.unlike(clickedComment.id)
				}
				else {
					this.like(clickedComment.id)
				}
				},
            like(commentId) {
                axios.post(`/like/${commentId}`).then(({ data }) => {
                	console.log(data);
                }).then(response=>{
					++this.count
					this.clickedComment.liked_by_user = true
				}).catch(err => {
				});
            },
			unlike(commentId) {
                axios.post(`/unlike/${commentId}`).then(({ data }) => {
                    console.log(data);
                }).then(response=>{
					--this.count
					this.clickedComment.liked_by_user = false
				}).catch(err => {
				});
            },
        },
    };
</script>
