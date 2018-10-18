<template>
	<div id="inspire">
		<v-navigation-drawer
				v-model="drawer"
				fixed
				app
		>
			<v-list dense>
				<template >

					<v-list-tile @click="">
						<v-list-tile-action>
							<v-icon>work</v-icon>
						</v-list-tile-action>
						<v-list-tile-content>
							<!--<v-list-tile-title><router-link  >Professions</router-link></v-list-tile-title>-->
						</v-list-tile-content>
					</v-list-tile>

					<v-list-tile @click="">
						<v-list-tile-action>
							<v-icon>build</v-icon>
						</v-list-tile-action>
						<v-list-tile-content>
							<!--<v-list-tile-title><router-link  :to="{ path: '/admin/service'}" exact>Services</router-link></v-list-tile-title>-->
						</v-list-tile-content>
					</v-list-tile>

					<v-list-tile @click="">
						<v-list-tile-action>
							<v-icon>person</v-icon>
						</v-list-tile-action>
						<v-list-tile-content>
							<!--<v-list-tile-title><router-link  :to="{ path: '/admin/contractor'}" exact>Contractors</router-link></v-list-tile-title>-->
						</v-list-tile-content>
					</v-list-tile>

					<v-list-tile @click="">
						<v-list-tile-action>
							<v-icon>list_alt</v-icon>
						</v-list-tile-action>
						<v-list-tile-content>
							<!--<v-list-tile-title><router-link  :to="{ path: '/admin/inquiry'}" exact>Inquiries</router-link></v-list-tile-title>-->
						</v-list-tile-content>
					</v-list-tile>

					<v-list-tile @click="">
						<v-list-tile-action>
							<v-icon>list_alt</v-icon>
						</v-list-tile-action>
						<v-list-tile-content>
							<!--<v-list-tile-title><router-link  :to="{ path: '/admin/page'}" exact>Pages</router-link></v-list-tile-title>-->
						</v-list-tile-content>
					</v-list-tile>

				</template>
			</v-list>
		</v-navigation-drawer>
		<v-toolbar color="indigo" dark fixed app>
			<v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
			<v-toolbar-title>Find.us.org</v-toolbar-title>
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


	export default {

		data: () => ({
			drawer: null,
			channels: []
		}),
		mounted() {
			axios.get('channels').then(response => {
				console.log(response.data);
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
		methods:{
			logout: () => {
				axios.post('/logout').then(response => {
					location.reload()

				}).catch(error => {
					console.log(error)
				})
			}
		},
		components:{
			// Profession,
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
			}).catch ( error => {
				if(error.response.status == '401'){

					window.location.href = '/login'
				}
			})
		}
	}
</script>
