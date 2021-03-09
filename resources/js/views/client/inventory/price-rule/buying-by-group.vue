<template>
    <div>
        <div style="padding:20px 30px;">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div style=" border:1px solid #efefef;">
                        {{ selected_supplier_group_uuids }}
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-left">Supplier Group Name</th>
                                    <th class="text-left">Suppliers</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr @click="selectGroup(group)"  style="cursor:pointer;" v-for="group in supplier_groups" :key="'group-' + group.uuid" v-bind:class="{'table-selected' : (selected_group && selected_group.uuid == group.uuid)}">
                                    <th width="30" class="text-center">
                                        <input @change="toggleSelectGroup(group);selectGroup(group)" type="checkbox">
                                    </th>
                                    <th>{{ group.group_name }}</th>
                                    <th width="20" class="text-right">{{ group.suppliers.length }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div v-if="selected_group" style=" border:1px solid #efefef;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-left">Supplier Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="supplier in selected_group.suppliers" :key="'supplier-' + supplier.uuid">
                                    <th width="30" class="text-center">
                                        <input type="checkbox">
                                    </th>
                                    <th>{{ supplier.supplier_name }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'buying-by-supplier',
    props: ['properties'],
    components: {
        
    },
    data: function () {
        return {
            supplier_groups: [],
            selected_group: null,
            selected_supplier_group_uuids: [],
        }
    },
    computed: {

    },
    methods: {
        getSupplierGroups: function () {
           var scope = this
            scope.GET('suppliers/supplier-group?keyword=&page=1&take=100&with=suppliers').then(res => {
                scope.supplier_groups = res.rows

                for (let i = 0; i < res.rows.length; i++) {
                    
                }
            })
        },
        toggleSelectGroup: function (group) {
            var scope = this
            var index = scope.selected_supplier_group_uuids.indexOf(group.uuid);
            if (index !== -1) {
                scope.selected_supplier_group_uuids.splice(index, 1);
            } else {
                scope.selected_supplier_group_uuids.push(group.uuid)
            }
        },
        selectGroup: function (group) {
            var scope = this
            scope.selected_group = group
        }
    },
    mounted() {
        var scope = this
        scope.getSupplierGroups()
    },
}
</script>