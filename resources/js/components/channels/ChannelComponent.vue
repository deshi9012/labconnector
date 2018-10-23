<template>
	<div>
		<h2>Channel {{id}}</h2>
		<ul id="messages">
			<li v-for="message in messages" :key="message.id"> {{ message.message }} : {{message.name }}</li>
		</ul>
		<v-btn v-if="!flagJoined" @click="join">Join</v-btn>
		<form @submit="send">
			<input type="text" v-model="newMessage">
			<button>Send</button>
		</form>


	</div>
</template>

<script>
	export default {

		name: "ChannelComponent",
		props: ["id"],

		data() {

			return {
				messages: [],
				newMessage: '',
				channelId: this.id,
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
					axios.post('message/create',
						{
							channelId: this.id,
							userId: window.App.user.id,
							name: this.fullName,
							message: this.newMessage
						})
						.then(response => {

							console.log(response.data);
						})
						.then(this.addMessage());
				}
			},

			join() {
				axios.get('channel-join/' + this.id).then(response => {
				// 	this.flagJoined = response.data;
				//

					// if(response.data === true){
					// 	return true;
					// }
					// return false;

				});


			},
			getChannelMessages(id) {
				axios.get('channel-messages/' + id).then((response) => {
					this.flagJoined=true;
					console.log(response.data.messages);
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
				}).catch(err => {
					this.flagJoined = false;
					console.log(err.response)
				})
			},
			addMessage() {
				this.messages.push({message: this.newMessage, name: '(Me)' + this.fullName});
				this.newMessage = '';
			}
		},
		watch: {
			id(newId, oldId) {

				window.Echo.leave('channel.' + oldId);
				this.messages = [];
				console.log('leave channel' + oldId);


				window.Echo.private('channel.' + newId)
					.listen('NewMessage', (e) => {/*actions*/

						console.log(e.message.message);
						this.messages.push({name: e.name, message: e.message.message});
					});

				this.getChannelMessages(newId);


			}
			// id(oldId, newId){
			// 	// console.log('old: ' + oldId);
			// 	// console.log('new: ' + newid);
			// 	Echo.leave('channel.' + oldId);
			//
			// 	Echo.channel('channel.' + newId).listen('NewMessage', e => {
			// 		console.log(newId);
			// 		console.log(e);
			// 	});
			// }
		},
		created() {
			console.log(this.id);
			window.Echo.private('channel.' + this.id).listen('NewMessage', e => {

				// console.log(e);
				// console.log(e.name);

				this.messages.push({name: e.name, message: e.message.message});
			});
			this.getChannelMessages(this.id);
		},
		// beforeDestroy() {
		// 	console.log('destroy' + this.id);
		// 	// Echo.leave('channel.' + this.id);
		// }

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