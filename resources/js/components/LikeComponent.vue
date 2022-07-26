<template>
	<button class="fas fa-thumbs-up mb-2" @click="onLikeClick()" :class="{ 'like-animation': islike }"> {{count}}</button>
</template>
<script>
    export default {
	    props: {
		    comment: Object,
		    likes_count: Number,
	    },
        data() {
            return {
				islike: this.comment.liked_by_user,
				count: this.likes_count,
			};
        },
        methods: {
			onLikeClick() {
				if(this.islike) {
					this.unlike(this.comment.id)
				}
				else {
					this.like(this.comment.id)
				}
				},
            like() {
                axios.post(`/like/${this.comment.id}`).then(({ data }) => {
                	console.log(data);
                }).then(response=>{
					++this.count
					this.islike = true
				}).catch(err => {
				});
            },
			unlike() {
                axios.post(`/unlike/${this.comment.id}`).then(({ data }) => {
                    console.log(data);
                }).then(response=>{
					--this.count
					this.islike = false
				}).catch(err => {
				});
            },
        },
    };
</script>
