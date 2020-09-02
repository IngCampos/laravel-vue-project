  
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
        <permission-section
          v-for="permission in permissions"
          :key="permission.info.id"
          :permission="permission"
        ></permission-section>
      </table>
    </div>
    <div>
      <permission-creation @creation="Creation(...arguments)"></permission-creation>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    Creation(new_user, permission_id) {
      this.permissions[permission_id].users.push(new_user);
      this.permissions[permission_id].users.orderByString("name");
    },
  },
  created() {
    axios.get("api/permission").then((response) => {
      response.data.forEach((element) => {
        axios.get(`api/permission/${element.id}`).then((response) => {
          this.permissions.push({ info: element, users: response.data });
        });
      });
    });
  },
  data() {
    return {
      permissions: [],
    };
  },
};
</script>