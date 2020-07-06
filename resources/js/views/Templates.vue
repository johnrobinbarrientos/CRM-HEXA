<template>
    <div>
       <SideBar></SideBar>
       <div class="kx-content-wrapper">
            <div class="kx-content-heading">
                <h2>&nbsp;</h2>
            </div>

            <div style="display:flex; justify-content: space-between; padding:10px 25px;">
                <div><h2 style="margin:0px;">Templates</h2></div>
                <div><button @click="toggleForm()" class="kx-btn-rounded kx-btn kx-btn-orange ">Add Company</button></div>
            </div>
            <div class="kx-content">
                <div v-if="show_form" class="kx-panel">
                    <div class="kx-panel-header">NEW TEMPLATE</div>
                    <div class="kx-panel-content">
                        <div class="kx-form-group">
                            <input placeholder="Name" v-model="data.name" type="text">
                        </div>
                        <div class="kx-form-group">
                            <input placeholder="Type" v-model="data.type" type="text">
                        </div>
                        <div class="kx-form-group">
                            <input placeholder="Description" v-model="data.description" type="text">
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
                            <th>Name</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in rows" :key="row.id">
                            <td>{{ row.name }}</td>
                            <td>{{ row.type }}</td>
                            <td>{{ row.description }}</td>
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
    name: 'companies',
    props: ['properties'],
    data: function () {
        return {
            show_form: false,
            data: {
                name: '',
                type: '',
                description: '',
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
            scope.SAVE_DATA('companies', scope.data).then(res => {
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
        scope.GET_ROWS('companies').then(res => {
            scope.rows = res.rows
        })
    }
}
</script>