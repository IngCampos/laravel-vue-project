  
<template>
  <table-container>
    <template v-slot:head>
      <th>
        Name <i class="fas fa-sort-alpha-down"></i>
      </th>
      <th style="min-width:170px" class="text-center">Created_at</th>
      <th style="min-width:130px" class="text-right">Actions</th>
    </template>
    <template v-slot:tbody>
      <permission-container
        v-for="permission in permissions"
        :key="permission.info.id"
        :permission="permission"
      ></permission-container>
    </template>
    <template v-slot:footer>
      <div>
        <permission-create @creation="Creation(...arguments)"></permission-create>
      </div>
    </template>
  </table-container>
</template>

<script>
export default {
  props: ["data"],
  methods: {
    Creation(new_user, permission_id) {
      this.permissions[permission_id].users.push(new_user);
      this.permissions[permission_id].users.orderByString("name");
    },
  },
  created() {
    this.permissions = JSON.parse(this.data);
  },
  data() {
    return {
      permissions: [],
    };
  },
};
</script>