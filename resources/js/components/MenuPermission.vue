<template>
  <div>
    <div class="new">
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
                  class="form-control w-50"
                  aria-label="Default select example"
                  name="user"
                  id="user"
                  v-model="userId"
                  @change="userChange(userIndex)"

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
                      <th>Submenu</th>
                      <th>Sub-Submenu</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="menu in menus" :key="menu.id">
                      <td>
                        <label>
                          <input
                            type="checkbox"
                            :value="menu"
                            v-model="selectedMenu"
                            name="menu[]"
                            @change="handleMenu(menu.id)"
                          />
                          {{ menu.menuName }}
                        </label>
                      </td>
                      <td
                        v-if="
                          selectedMenu.filter((s) =>
                            filteredProduct(menu.id).some(
                              (i) => i.menuId === s.id
                            )
                          ).length
                        "
                      >
                        <ul>
                          <label>
                            <input
                              type="checkbox"
                              :value="menu.id"
                              v-model="selectedAllSubMenu"
                              @change="selectAllSubMenu(menu.id)"
                              name="submenu[]"
                            />
                            Select all
                          </label>
                          <li
                            v-for="submenu in filteredProduct(menu.id)"
                            :key="submenu.id"
                          >
                            <label>
                              <input
                                type="checkbox"
                                :value="submenu"
                                v-model="selectedSubMenu"
                                @change="selectSubMenu(menu.id)"
                              />
                              {{ submenu.subMenuName }}
                            </label>
                          </li>
                        </ul>
                      </td>
                      <td v-else>
                        <p>
                          Please select <b>{{ menu.menuName }}</b> menu
                        </p>
                      </td>
                      <div
                        class="subsubmenus"
                        v-for="submenu in submenus"
                        :key="submenu.id"
                      >
                        <td v-if="submenu.menuId == menu.id">
                          <ul>
                            <li
                              v-for="subsubmenu in filteredSub_submenu(
                                submenu.id
                              )"
                              :key="subsubmenu.id"
                            >
                              <div v-for="x in selectedSubMenu" :key="x.id">
                                <label v-if="x.id === subsubmenu.submenuId">
                                  <input
                                    type="checkbox"
                                    :value="subsubmenu"
                                    v-model="selectedSubSubMenu"
                                  />
                                  {{ subsubmenu.sub_subMenuName }}
                                </label>
                              </div>
                            </li>
                          </ul>
                        </td>
                      </div>
                      <td
                        v-if="
                          selectedMenu.filter((s) =>
                            filteredProduct(menu.id).some(
                              (i) => i.menuId === s.id
                            )
                          ).length
                        "
                        class="permission-action"
                      >
                        <label class="btn bg-success">
                          <input
                            type="checkbox"
                            name="action[]"
                            v-model="selectedActions"
                            :value="{ name: 'Create', menu: menu.id }"
                          />Create</label
                        ><br />
                        <label class="btn bg-primary">
                          <input
                            type="checkbox"
                            name="action[]"
                            v-model="selectedActions"
                            :value="{ name: 'Edit', menu: menu.id }"
                          />Edit</label
                        ><br />
                        <label class="btn bg-danger">
                          <input
                            type="checkbox"
                            name="action[]"
                            v-model="selectedActions"
                            :value="{ name: 'delete', menu: menu.id }"
                          />Delete</label
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="text-center mt-3">
                  <button
                    v-if="isUserInPreviousUsers"
                    class="btn btn-primary"
                    @click="update"
                  >
                    Update
                  </button>
                  <button v-else class="btn btn-primary" @click="add">
                    Submit
                  </button>
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
      previousUsers: [],
      id: "",
      userId: "",
      selectedPermission: {
        menuIds: [],
        subMenuIds: [],
        actions: [],
        subsubMenuIds: [],
      },
      selectedAllSubMenu: [],
      selectedActions: [],
      selectedMenu: [],
      selectedSubMenu: [],
      selectedSubSubMenu: [],
      subsubmenus: [],
      menus: [],
      submenus: [],
      users: [],
    };
  },
  computed: {
    isUserInPreviousUsers() {
      return this.previousUsers.indexOf(this.userId) >= 0;
    },
  },

  methods: {
    filteredProduct(id) {
      return this.submenus.filter((s) => s.menuId === id);
    },
    filteredSub_submenu(id) {
      return this.subsubmenus.filter((s) => s.submenuId === id);
    },
    selectSubMenu(id) {
      if (
        this.selectedSubMenu.filter((s) => s.menuId === id).length ===
        this.submenus.filter((s) => s.menuId === id).length
      ) {
        this.selectedAllSubMenu.push(id);
      } else {
        this.selectedAllSubMenu = this.selectedAllSubMenu.filter(
          (s) => s !== id
        );
      }
    },
    selectAllSubMenu(id) {
      const checked = this.selectedAllSubMenu.some((s) => s === id);
      if (
        this.selectedSubMenu.filter((s) => s.menuId === id).length ===
          this.submenus.filter((s) => s.menuId === id).length &&
        !checked
      ) {
        this.selectedSubMenu = this.selectedSubMenu.filter(
          (s) => s.menuId !== id
        );
      } else if (checked) {
        this.selectedSubMenu = [
          ...new Set(
            [...this.selectedSubMenu].concat(
              this.submenus.filter((s) => s.menuId === id)
            )
          ),
        ];
      }
    },

    handleMenu(id) {
      if (!this.selectedMenu.find((s) => s.id === id)) {
        this.selectedSubMenu = this.selectedSubMenu.filter(
          (s) => s.menuId !== id
        );
        this.selectedAllSubMenu = this.selectedAllSubMenu.filter(
          (s) => s !== id
        );
        this.selectedActions = this.selectedActions.filter(
          (s) => s.menu !== id
        );
      }
    },
    userChange(userIndex) {
      (this.selectedActions.length = 0),
        (this.selectedMenu.length = 0),
        (this.selectedSubMenu.length = 0);
      axios
        .get("/api/selected-permission", {
          params: {
            userId: this.userId,
          },
        })
        .then(
          function (response) {
            this.id = response.data[0].id;
            this.selectedPermission.menuIds = response.data[0].menuIds;
            this.selectedPermission.actions = response.data[0].actions;
            this.selectedPermission.subMenuIds = response.data[0].subMenuIds;
            this.selectedPermission.subsubMenuIds =
              response.data[0].subsubMenuIds;
            var menufromdb = JSON.parse(response.data[0].menuIds);
            var submenufromdb = JSON.parse(response.data[0].subMenuIds);
            var subsubmenufromdb = JSON.parse(response.data[0].subsubMenuIds);

            var actionsfromdb = JSON.parse(response.data[0].actions);

            for (let index = 0; index < menufromdb.length; index++) {
              this.selectedMenu.push(menufromdb.at(index));
            }
            for (let index = 0; index < submenufromdb.length; index++) {
              this.selectedSubMenu.push(submenufromdb.at(index));
            }
            for (let index = 0; index < subsubmenufromdb.length; index++) {
              this.selectedSubSubMenu.push(subsubmenufromdb.at(index));
            }
            for (let index = 0; index < actionsfromdb.length; index++) {
              this.selectedActions.push(actionsfromdb.at(index));
            }
          }.bind(this)
        );
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
    subsubmenuList() {
      axios.get("/api/sub-subMenuList").then((response) => {
        this.subsubmenus = response.data;
      });
    },
    userList() {
      axios.get("/api/userlist").then((response) => {
        this.users = response.data;
      });
    },
    add() {
      if (this.userId !== "") {
        axios
          .post("/api/menu-permission", {
            user: this.userId,
            menu: this.selectedMenu,
            submenu: this.selectedSubMenu,
            subsubmenu: this.selectedSubSubMenu,
            action: this.selectedActions,
          })
          .then((response) => {
            console.log(response.data);
            this.$toast.success(`Permissions Saved Successfully`);
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.$toast.error(`Select an user`);
      }

      this.previousPermissionList();
    },
    update() {
      axios
        .post("/api/update-menu-permission/" + this.id, {
          user: this.userId,
          menu: this.selectedMenu,
          submenu: this.selectedSubMenu,
          subsubmenu: this.selectedSubSubMenu,
          action: this.selectedActions,
        })
        .then((response) => {
          console.log(response.data);
          this.$toast.success(`Permissions Updated Successfully`);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    previousPermissionList() {
      axios.get("/api/previous-permission").then((response) => {
        for (let index = 0; index < response.data.length; index++) {
          this.previousUsers.push(response.data[index].userId);
        }
      });
    },
  },
  mounted() {
    this.menuList();
    this.userList();
    this.submenuList();
    this.subsubmenuList();
    this.previousPermissionList();
  },
};
</script>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
.subsubmenus td {
  border: none;
}
</style>
