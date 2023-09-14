<template>
  <div>
    <div v-if="selectedPermission.userId !== 'null'">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div
                class="
                  card-header
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                <h5 class="w-100">Menu Permission</h5>
                <select
                  class="form-select"
                  aria-label="Default select example"
                  name="user"
                  id="user"
                  v-model="selectedPermission.userId"
                  @change="userChange()"
                >
                  <option value="">Select an User</option>
                  <option v-for="user in users" :value="user.id" :key="user.id">
                    {{ user.name }}
                  </option>
                </select>
              </div>
              <div class="card-body">
                <table class="table justify-content-center">
                  <thead>
                    <tr>
                      <th>Menu</th>
                      <th v-if="selectedMenu.length > 0">Submenu</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="menu in menus" :key="menu.id">
                      <td>
                        <label>
                          <input
                            type="checkbox"
                            name="menu[]"
                            v-model="selectedMenu"
                            :value="menu.id"
                            @change="submenuChange"
                          />
                          {{ menu.menuName }}
                        </label>
                      </td>
                      <td
                        class="border-right-thin"
                        v-if="selectedMenu.length !== 0"
                      >
                        <ul>
                          <li
                            v-for="submenu in filteredProduct"
                            :key="submenu.id"
                          >
                            <div v-if="menu.id == submenu.menuId">
                              <label>
                                <input
                                  type="checkbox"
                                  :value="submenu.id"
                                  v-model="selectedSubMenu"
                                />
                                {{ submenu.subMenuName }}
                              </label>
                            </div>
                          </li>
                        </ul>
                      </td>
                      <td
                        v-if="menu.id === menus.length - 1"
                        class="permission-action"
                      >
                        <label class="btn bg-success">
                          <input
                            type="checkbox"
                            name="action[]"
                            v-model="selectedActions"
                            value="Create"
                          />Create</label
                        ><br />
                        <label class="btn bg-primary">
                          <input
                            type="checkbox"
                            name="action[]"
                            v-model="selectedActions"
                            value="Edit"
                          />Edit</label
                        ><br />
                        <label class="btn bg-danger">
                          <input
                            type="checkbox"
                            name="action[]"
                            v-model="selectedActions"
                            value="Delete"
                          />Delete</label
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="text-center mt-3">
                  <button class="btn btn-primary" @click="update">
                    Update
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="new">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div
                class="
                  card-header
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                <h5 class="w-50">Menu Permission</h5>
                <select
                  class="form-select"
                  aria-label="Default select example"
                  name="user"
                  id="user"
                  v-model="selectedPermission.userId"
                  @change="userChange()"
                >
                  <option value="">Select an User</option>
                  <option v-for="user in users" :value="user.id" :key="user.id">
                    {{ user.name }}
                  </option>
                </select>
              </div>
              <div class="card-body">
                <table class="table justify-content-center">
                  <thead>
                    <tr>
                      <th>Menu</th>
                      <th v-if="selectedMenu.length > 0">Submenu</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="menu in menus" :key="menu.id">
                      <td>
                        <label>
                          <input
                            type="checkbox"
                            name="menu[]"
                            v-model="selectedMenu"
                            :value="menu.id"
                          />
                          {{ menu.menuName }}
                        </label>
                      </td>
                      <td
                        class="border-right-thin"
                        v-if="selectedMenu.length !== 0"
                      >
                        <ul>
                          <li
                            v-for="submenu in filteredProduct"
                            :key="submenu.id"
                          >
                            <div v-if="menu.id == submenu.menuId">
                              <label>
                                <input
                                  type="checkbox"
                                  :value="submenu.id"
                                  v-model="selectedSubMenu"
                                />
                                {{ submenu.subMenuName }}
                              </label>
                            </div>
                          </li>
                        </ul>
                      </td>
                      <td

                        class="permission-action"
                      >
                        <label class="btn bg-success">
                          <input
                            type="checkbox"
                            name="action[]"
                            v-model="selectedActions"
                            value="Create"
                          />Create</label
                        ><br />
                        <label class="btn bg-primary">
                          <input
                            type="checkbox"
                            name="action[]"
                            v-model="selectedActions"
                            value="Edit"
                          />Edit</label
                        ><br />
                        <label class="btn bg-danger">
                          <input
                            type="checkbox"
                            name="action[]"
                            v-model="selectedActions"
                            value="Delete"
                          />Delete</label
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="text-center mt-3">
                  <button class="btn btn-primary" @click="add">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectedPermission: {
        id: "",
        userId: "",
        menuIds: [],
        subMenuIds: [],
        actions: [],
      },
      selectedActions: [],
      selectedMenu: [],
      selectedSubMenu: [],
      menus: [],
      submenus: [],
      users: []
    };
  },
  computed: {
    filteredProduct() {
      const app = this,
        menu = app.selectedMenu;
      if (menu.includes("0")) {
        return app.submenus;
      } else {
        return app.submenus.filter(function (item) {
          return menu.indexOf(item.menuId) >= 0;
        });
      }
    },
  },
  methods: {
    submenuChange(){

    },
    userChange(){
      this.selectedActions.length = 0,
      this.selectedMenu.length = 0,
      this.selectedSubMenu.length = 0
    },
    menuList() {
      axios.get("/api/menuList").then((response) => {
        this.menus = response.data;
      });
    },
    submenuList() {
      axios.get("/api/subMenuList").then((response) => {
        this.submenus = response.data;
      });
    },
    selectedPermissionList() {
      axios.get("/api/selected-permission").then((response) => {
        this.selectedPermission.id = response.data[0].id;
        this.selectedPermission.userId = response.data[0].userId;
        this.selectedPermission.menuIds = response.data[0].menuIds;
        this.selectedPermission.actions = response.data[0].actions;
        this.selectedPermission.subMenuIds = response.data[0].subMenuIds;
        var menufromdb = JSON.parse(response.data[0].menuIds);
        var submenufromdb = JSON.parse(response.data[0].subMenuIds);
        var actionsfromdb = JSON.parse(response.data[0].actions);

        for (let index = 0; index < menufromdb.length; index++) {
          this.selectedMenu.push(menufromdb.at(index));
        }
        for (let index = 0; index < submenufromdb.length; index++) {
          this.selectedSubMenu.push(submenufromdb.at(index));
        }
        for (let index = 0; index < actionsfromdb.length; index++) {
          this.selectedActions.push(actionsfromdb.at(index));
        }
      });
    },
    userList() {
      axios.get("/api/userlist").then((response) => {
        this.users = response.data;
      });
    },
    add() {
      axios
        .post("/api/menu-permission", {
          user: this.selectedPermission.userId,
          menu: this.selectedMenu,
          submenu: this.selectedSubMenu,
          action: this.selectedActions,
        })
        .then((response) => {
          console.log(response.data);
          document.getElementById("result").innerHTML = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    update() {
      axios
        .post("/api/update-menu-permission/" + this.selectedPermission.id, {
          user: this.selectedPermission.userId,
          menu: this.selectedMenu,
          submenu: this.selectedSubMenu,
          action: this.selectedActions,
        })
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.menuList();
    this.userList();
    this.submenuList();
    this.selectedPermissionList();
  },
};
</script>
<style>
.permission-action {
  border-bottom-width: 0 !important;
  border-top: 0 !important;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
ul li {
  display: inline;
}
.border-right-thin {
  border-right-width: thin !important;
}
</style>
