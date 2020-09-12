  
<template>
  <div>
    <div style="overflow-x:auto;">
      <table style="width:100%" class="table table-striped">
        <thead>
          <th style="min-width:90px">
            Status | Name
            <i class="fas fa-sort-alpha-down"></i>
          </th>
          <th style="min-width:125px">Email</th>
          <th class="text-center">Department</th>
          <th style="width:30px">
            <i class="fas fa-user-cog float-right"></i>
          </th>
        </thead>
        <tbody>
          <user-element
            v-for="(user, index) in users"
            :key="index"
            :user="user"
            @enable="Enable(index)"
            @justupdate="justUpdate(index,...arguments)"
            @update="changePage(pagination.current_page)"
            :department_form="department_form"
          ></user-element>
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <li class="page-item" v-bind:class="[ pagination.current_page > 1 ? '' : 'disabled' ]">
            <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
              <span>Previous</span>
            </a>
          </li>
          <li
            v-for="page in pagesNumber"
            v-bind:class="[ page == isActive ? 'active' : '' ]"
            :key="page"
            class="page-item"
          >
            <a class="page-link" href="#" @click.prevent="changePage(page)">{{page}}</a>
          </li>
          <li
            class="page-item"
            v-bind:class="[ pagination.current_page < pagination.last_page ? '' : 'disabled' ]"
          >
            <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
              <span>Next</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <user-creation
      :department_form="department_form"
      @creation="changePage(pagination.current_page)"
    ></user-creation>
  </div>
</template>

<script>
export default {
  computed: {
    isActive: function () {
      return this.pagination.current_page;
    },
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) from = 1;
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) to = this.pagination.last_page;
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
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
    justUpdate(index, data) {
      this.users[index] = data;
      this.$forceUpdate();
    },
    changePage(page) {
      this.pagination.current_page = page;
      this.getUsers(page);
    },
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