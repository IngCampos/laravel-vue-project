  
<template>
  <table-container>
    <template v-slot:head>
      <th class="col-name">Status | Name <i class="fas fa-sort-alpha-down"/></th>
      <th>Email</th>
      <th>Department</th>
      <th><i class="fas fa-user-cog"/></th>
    </template>
    <template v-slot:body>
      <user-row
        v-for="(user, index) in users"
        :key="index"
        :user="user"
        @enable="Enable(index)"
        @delete="Delete(index)"
        @justupdate="justUpdate(index,...arguments)"
        @update="changePage(pagination.current_page)"
        :department_form="department_form"
      ></user-row>    
    </template>
    <template v-slot:footer>
      <pagination
       :pagination="pagination" 
       :offset="offset"
       @changePage="getUsers(...arguments)"/>
      <div class="form-group">
        <user-create
          :department_form="department_form"
          @creation="changePage(pagination.current_page)"
        ></user-create>
      </div>
    </template>
  </table-container>
</template>
// TODO: Create a view for watching the deleted users.
<script>
export default {
  methods: {
    getUsers(page) {
      axios.get("api/user?page=" + page).then((response) => {
        this.users = response.data.users;
        this.pagination = response.data.pagination;
      });
    },
    Enable(index) {
      this.users[index].isEnabled = !this.users[index].isEnabled;
    },
    Delete(index) {              
      this.users.splice(index, 1);
    },
    justUpdate(index, data) {
      this.users[index] = data;
      this.$forceUpdate();
    }
  },
  created() {
    axios.get("api/data_department").then((response) => {
      this.department_form = response.data;
    });
    this.getUsers(1);
  },
  data() {
    return {
      department_form: {},
      users: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
    };
  },
};
</script>