  
<template>
  <div>
    <div style="overflow-x:auto;">
      <table style="width:100%" class="table">
        <thead>
          <th>
            Name
            <i class="fas fa-sort-alpha-down"></i>
          </th>
          <th style="min-width:170px" class="text-center">Created_at</th>
          <th style="min-width:130px" class="text-right">Actions</th>
        </thead>
        <permission-container
          v-for="permission in permissions"
          :key="permission.info.id"
          :permission="permission"
        ></permission-container>
      </table>
    </div>
    <div>
      <permission-create @creation="Creation(...arguments)"></permission-create>
    </div>
  </div>
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