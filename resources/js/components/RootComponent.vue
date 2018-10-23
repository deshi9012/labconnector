<template>
	<div id="inspire">
		<v-navigation-drawer
				v-model="drawer"
				fixed
				app
		>
			<v-list dense>
				<template>
					<v-subheader inset>Channels</v-subheader>
					<v-list-tile v-for="channel in channels" :key="channel.id" @click="">
						<v-list-tile-action>
							<v-icon>build</v-icon>
						</v-list-tile-action>

						<v-list-tile-content>

							<v-list-tile-title>
								<router-link :to="{ path: '/channel/' + channel.id}" exac>{{channel.name}}</router-link>
							</v-list-tile-title>
						</v-list-tile-content>
					</v-list-tile>
					<v-text-field
							label="Add channel"
							v-model="newChannel"
					></v-text-field>
					<v-btn color="info" @click="addChannel">add</v-btn>

					<v-divider inset></v-divider>
					<v-subheader inset>Users</v-subheader>
					<v-list-tile @click="">
						<v-list-tile-action>
							<v-icon>build</v-icon>
						</v-list-tile-action>
						<v-list-tile-content>
							<!--<v-list-tile-title><router-link  :to="{ path: '/admin/service'}" exact>Services</router-link></v-list-tile-title>-->
						</v-list-tile-content>
					</v-list-tile>

				</template>
			</v-list>
		</v-navigation-drawer>
		<v-toolbar color="indigo" dark fixed app>
			<v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
			<v-toolbar-title>Labconnector</v-toolbar-title>
			<v-spacer></v-spacer>
			<v-btn @click="logout">
				Logout
			</v-btn>

		</v-toolbar>
		<v-content>
			<v-container fluid fill-height>
				<v-layout
						justify-center
						align-center
				>
					<v-flex text-xs-center>
						<router-view></router-view>
					</v-flex>
				</v-layout>
			</v-container>
		</v-content>
		<v-footer color="indigo" app>
			<span class="white--text">&copy; 2017</span>
		</v-footer>

	</div>
</template>

<script>
	import Channel from './channels/ChannelComponent'

	export default {

		data: () => ({
			drawer: null,
			newChannel: '',
			channels: []
		}),
		mounted() {
			axios.get('channels').then(response => {
				this.channels = response.data;
			});
		},
		props: {
			// source: String
		},
		computed: {
			// getUser() {
			// 	return this.$store.getters.user
			// }
		},
		methods: {
			logout: () => {
				axios.post('/logout').then(response => {
					location.reload()

				}).catch(error => {
					console.log(error)
				})
			},
			addChannel() {
				if (this.newChannel) {
					axios.post('/channel/create', {channelName: this.newChannel}).then(response => {
						this.channels.push(response.data);
						this.newChannel = '';

					});
				}
			}
		},
		components: {
			Channel
			// ServiceList,
			// ServiceCreate,
			// ServiceUpdate,
			// Navigation,
			// ContractorList,
			// ContractorCreate,
			// InquiryList,
			// InquiryUpdate,
			// InquiryCreate,
			// PageList,
			// PageCreate,
			// PageUpdate,
		},
		beforeCreate: () => {

			axios.get('/checkAuth').then(response => {
			}).catch(error => {
				if (error.response.status == '401') {

					window.location.href = '/login'
				}
			})
		}
	}
</script>
