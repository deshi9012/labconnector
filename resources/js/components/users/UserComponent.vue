<template>
	<div>
		<h2>User {{id}}</h2>
		<ul id="messages">
			<li v-for="message in messages" :key="message.id"> {{ message.message }} : {{message.name }}</li>
		</ul>
		<!--<v-btn v-if="!flagJoined" @click="join">Write first</v-btn>-->
		<form @submit="send">
			<input type="text" v-model="newMessage">
			<button>Send</button>
		</form>


	</div>
</template>

<script>
	export default {

		name: "UserComponent",
		props: ["id"],

		data() {

			return {
				messages: [],
				newMessage: '',
				channelId: '',
				flagJoined: false
			}
		},
		computed: {
			channel() {
				return window.Echo.join('channel.' + this.channelId);
			},
			fullName() {
				return this.$store.getters.user.first_name + ' ' + this.$store.getters.user.last_name;
			}
		},
		methods: {
			send() {
				if (this.newMessage) {
					axios.post('messages/create',
						{
							channelId: this.channelId,
							userId: this.$store.getters.user.id,
							name: this.fullName,
							message: this.newMessage
						})
						.then(response => {

							console.log(response.data);
						})
						.then(this.addMessage());
				}
			},
			addMessage() {
				this.messages.push({message: this.newMessage, name: '(Me)' + this.fullName});
				this.newMessage = '';
			},
			checkUserMask(userId) {
				axios.post('/channels/users-mask/check', {userId: userId}).then(response => {

					if (response.data.messages !==undefined && response.data.messages.length > 0) {
						response.data.messages.forEach((message, index) => {
							if (this.$store.getters.user.id == message.user.id) {
								this.messages.push({
									message: message.message,
									name: '(Me)' + message.user.first_name + ' ' + message.user.last_name
								});
							} else {
								this.messages.push({
									message: message.message,
									name: message.user.first_name + ' ' + message.user.last_name
								});
							}
						})
					}

					this.flagJoined = true;
					this.channelId = response.data.id;
					window.Echo.private('channel.' + response.data.id)
						.listen('NewMessage', (e) => {/*actions*/

							console.log(e.message.message);
							this.messages.push({name: e.name, message: e.message.message});
						});
					console.log('enter' + response.data.id);
				})
			},

		},
		watch: {
			id(newId, oldId) {
				// console.log('old:' + oldId);
				window.Echo.leave('channel.' + this.channelId);
				this.messages = [];
				console.log('leave channel' + this.channelId);
				this.checkUserMask(newId);
			}
		},
		created() {
			this.checkUserMask(this.id);
		},
	}
</script>

<style scoped>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	body {
		font: 13px Helvetica, Arial;
	}

	form {
		background: #000;
		padding: 3px;
		position: fixed;
		bottom: 40px;
		width: 80%;
	}

	form input {
		border: 0;
		padding: 10px;
		width: 90%;
		margin-right: .5%;
		background-color: white
	}

	form button {
		width: 9%;
		background: rgb(130, 224, 255);
		border: none;
		padding: 10px;
	}

	#messages {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}

	#messages li {
		padding: 5px 10px;
		text-align: right;
	}

	#messages li:nth-child(odd) {
		background: #eee;
	}
</style>