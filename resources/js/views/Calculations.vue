<template>
    <div>
       <SideBar></SideBar>
       <div class="kx-content-wrapper">
            <div class="kx-content-heading">
                <h2>&nbsp;</h2>
            </div>

            <div style="display:flex; justify-content: space-between; padding:10px 25px;">
                <div><h2 style="margin:0px;">Benchmarks</h2></div>
                <div><button @click="toggleForm()" class="kx-btn-rounded kx-btn kx-btn-orange ">Add Benchmarks</button></div>
            </div>
            <div class="kx-content">
                <div v-if="show_form" class="kx-panel">
                    <div class="kx-panel-header">NEW BENCHMARK</div>
                    <div class="kx-panel-content">
                        <div class="kx-form-group">
                            <input placeholder="Title" v-model="data.title" type="email">
                        </div>
                        <div class="kx-form-group">
                            <input placeholder="Prospect" v-model="data.prospect" type="text">
                        </div>
                        <div class="kx-form-group">
                            <input placeholder="Marketing Qualified" v-model="data.marketing_qualitfied" type="text">
                        </div>
                        <div class="kx-form-group">
                            <input placeholder="Sales Accepted" v-model="data.sales_accepted" type="text">
                        </div>
                        <div class="kx-form-group">
                            <input placeholder="Closed Won" v-model="data.closed_won" type="text">
                        </div>
                        <div class="kx-form-group">
                            <input placeholder="Closed Won Revenue" v-model="data.closed_won_revenue" type="text">
                        </div>
                    </div>
                    <div class="kx-panel-footer">
                        <button @click="save()" class="kx-btn-orange">Save</button>
                        <button @click="toggleForm()" class="kx-btn-white">Close</button>
                    </div>
                </div>
                <table v-if="!show_form" class="kx-table">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in rows" :key="row.id">
                            <td>{{ row.email }}</td>
                            <td>{{ row.first_name }}</td>
                            <td>{{ row.last_name }}</td>
                            <td>
                                <button><i class="las la-pencil-alt"></i></button>
                                <button><i class="las la-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import SideBar from './components/SideBar'
export default {
    name: 'users',
    props: ['properties'],
    data: function () {
        return {
            show_form: false,
            data: {
                firstname: '',
                lastname: '',
                email: '',
                password: '',
            },
            rows: {

            }
        }
    },
    components: {
        SideBar
    },
    methods: {
        toggleForm: function () {
           var scope = this;
           scope.show_form = !scope.show_form
        },
        save: function () {
            var scope = this
            scope.SAVE_DATA('users', scope.data).then(res => {
                if (res.success) {
                    scope.rows.push(res.data)
                    scope.toggleForm()
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        }
    },
    mounted() {
        var scope = this
        scope.GET_ROWS('users').then(res => {
            scope.rows = res.rows
        })
    }
}
</script>