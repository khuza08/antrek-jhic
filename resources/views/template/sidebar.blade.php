      <!-- ===== Sidebar Start ===== -->
      <aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
          class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0">
          <!-- SIDEBAR HEADER -->
          <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
              class="flex items-center gap-2 pt-8 sidebar-header pb-7">
              <a href="index.html">
                  <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                      <img class="dark:hidden" src="{{ asset('tailadmin/build/src/images/logo/logo.svg') }}"
                          alt="Logo" />
                      <img class="hidden dark:block" src="{{ asset('tailadmin/build/src/images/logo/logo-dark.svg') }}"
                          alt="Logo" />
                  </span>

                  <img class="logo-icon" :class="sidebarToggle ? 'lg:block' : 'hidden'"
                      src="{{ asset('tailadmin/build/src/images/logo/logo-icon.svg') }}" alt="Logo" />
              </a>
          </div>
          <!-- SIDEBAR HEADER -->

          <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
              <!-- Sidebar Menu -->
              <nav x-data="{ selected: $persist('Dashboard') }">
                  <!-- Menu Group -->
                  <div>
                      <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                          <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                              MENU
                          </span>

                          <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                              class="mx-auto fill-current menu-group-icon" width="24" height="24"
                              viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                  fill="" />
                          </svg>
                      </h3>

                      <ul class="flex flex-col gap-4 mb-6">
                          <!-- Menu Item Dashboard -->
                          <li>
                              <a href="/dashboard" class="menu-item group"
                                  :class="(selected === 'Dashboard') || (page === 'ecommerce' || page === 'analytics' ||
                                      page === 'marketing' || page === 'crm' || page === 'stocks') ?
                                  'menu-item-active' : 'menu-item-inactive'">

                                  <!-- Icon Dashboard -->
                                  <svg :class="(selected === 'Dashboard') || (page === 'ecommerce' || page === 'analytics' ||
                                      page === 'marketing' || page === 'crm' || page === 'stocks') ?
                                  'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                      width="24" height="24" viewBox="0 0 24 24" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                          fill="" />
                                  </svg>

                                  <!-- Teks Dashboard -->
                                  <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                      Dashboard
                                  </span>
                              </a>
                          </li>

                          <!-- Menu Item Dashboard -->

                          <!-- Menu Item Tables -->
                          <li>
                              <a href="#" @click.prevent="selected = (selected === 'Tables' ? '':'Tables')"
                                  class="menu-item group"
                                  :class="(selected === 'Tables') || (page === 'basicTables' || page === 'dataTables') ?
                                  'menu-item-active' : 'menu-item-inactive'">
                                  <svg :class="(selected === 'Tables') || (page === 'basicTables' || page === 'dataTables') ?
                                  'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                      width="24" height="24" viewBox="0 0 24 24" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M12 2C7.029 2 3 3.79 3 6v12c0 2.21 4.029 4 9 4s9-1.79 9-4V6c0-2.21-4.029-4-9-4Zm0 1.5c4.418 0 7.5 1.343 7.5 2.5S16.418 8.5 12 8.5 4.5 7.157 4.5 6 7.582 3.5 12 3.5ZM4.5 8.825V11c0 1.157 3.082 2.5 7.5 2.5s7.5-1.343 7.5-2.5V8.825c-1.726 1.015-4.457 1.675-7.5 1.675s-5.774-.66-7.5-1.675ZM4.5 13.325V15.5c0 1.157 3.082 2.5 7.5 2.5s7.5-1.343 7.5-2.5v-2.175c-1.726 1.015-4.457 1.675-7.5 1.675s-5.774-.66-7.5-1.675Zm0 4.65V18c0 1.157 3.082 2.5 7.5 2.5s7.5-1.343 7.5-2.5v-.025C17.274 18.99 14.543 19.65 11.5 19.65s-5.774-.66-7.5-1.675Z"
                                          fill="currentColor" />
                                  </svg>


                                  <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                      Manage
                                  </span>

                                  <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                                      :class="[(selected === 'Tables') ? 'menu-item-arrow-active' :
                                          'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                                      ]"
                                      width="20" height="20" viewBox="0 0 20 20" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke=""
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>
                              </a>

                              <!-- Dropdown Menu Start -->
                              <div class="overflow-hidden transform translate"
                                  :class="(selected === 'Tables') ? 'block' : 'hidden'">
                                  <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                      class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                      <li>
                                          <a href="{{ route('guru-table') }}" class="menu-dropdown-item group"
                                              :class="page === 'basicTables' ? 'menu-dropdown-item-active' :
                                                  'menu-dropdown-item-inactive'">
                                              Data Guru
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                              <div class="overflow-hidden transform translate"
                                  :class="(selected === 'Tables') ? 'block' : 'hidden'">
                                  <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                      class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                      <li>
                                          <a href="{{ route('majors-table') }}" class="menu-dropdown-item group"
                                              :class="page === 'basicTables' ? 'menu-dropdown-item-active' :
                                                  'menu-dropdown-item-inactive'">
                                              Data Jurusan
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                              <div class="overflow-hidden transform translate"
                                  :class="(selected === 'Tables') ? 'block' : 'hidden'">
                                  <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                      class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                      <li>
                                          <a href="{{ route('berita-table') }}" class="menu-dropdown-item group"
                                              :class="page === 'basicTables' ? 'menu-dropdown-item-active' :
                                                  'menu-dropdown-item-inactive'">
                                              Berita
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                              <div class="overflow-hidden transform translate"
                                  :class="(selected === 'Tables') ? 'block' : 'hidden'">
                                  <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                      class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                      <li>
                                          <a href="{{ route('prestasi-table') }}" class="menu-dropdown-item group"
                                              :class="page === 'basicTables' ? 'menu-dropdown-item-active' :
                                                  'menu-dropdown-item-inactive'">
                                              Prestasi
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                              <div class="overflow-hidden transform translate"
                                  :class="(selected === 'Tables') ? 'block' : 'hidden'">
                                  <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                      class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                      <li>
                                          <a href="{{ route('Galeri-table') }}" class="menu-dropdown-item group"
                                              :class="page === 'basicTables' ? 'menu-dropdown-item-active' :
                                                  'menu-dropdown-item-inactive'">
                                              Galery
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                              <div class="overflow-hidden transform translate"
                                  :class="(selected === 'Tables') ? 'block' : 'hidden'">
                                  <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                      class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                      <li>
                                          <a href="{{ route('kategori-table') }}" class="menu-dropdown-item group"
                                              :class="page === 'basicTables' ? 'menu-dropdown-item-active' :
                                                  'menu-dropdown-item-inactive'">
                                              Kategori
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                              <!-- Dropdown Menu End -->
                          </li>
                          <!-- Menu Item Tables -->

                          <!-- Menu Item Forms -->
                          <li>
                              <a href="#" @click.prevent="selected = (selected === 'Forms' ? '':'Forms')"
                                  class="menu-item group"
                                  :class="(selected === 'Forms') || (page === 'formElements' || page === 'formLayout' ||
                                      page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' :
                                  'menu-item-inactive'">
                                  <svg :class="(selected === 'Settings') || (page === 'generalSettings' ||
                                      page === 'userSettings') ?
                                  'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                      xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                      viewBox="0 0 24 24" fill="none">
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M19.14 12.94c.04-.31.06-.63.06-.94s-.02-.63-.06-.94l2.03-1.58a.5.5 0 0 0 .12-.64l-1.92-3.32a.5.5 0 0 0-.6-.22l-2.39.96a7.05 7.05 0 0 0-1.62-.94l-.36-2.54A.5.5 0 0 0 14.3 2h-4.6a.5.5 0 0 0-.5.42l-.36 2.54c-.59.24-1.13.55-1.62.94l-2.39-.96a.5.5 0 0 0-.6.22L2.31 8.84a.5.5 0 0 0 .12.64l2.03 1.58c-.04.31-.06.63-.06.94s.02.63.06.94l-2.03 1.58a.5.5 0 0 0-.12.64l1.92 3.32a.5.5 0 0 0 .6.22l2.39-.96c.49.39 1.03.7 1.62.94l.36 2.54a.5.5 0 0 0 .5.42h4.6a.5.5 0 0 0 .5-.42l.36-2.54c.59-.24 1.13-.55 1.62-.94l2.39.96a.5.5 0 0 0 .6-.22l1.92-3.32a.5.5 0 0 0-.12-.64l-2.03-1.58ZM12 15.5A3.5 3.5 0 1 0 12 8.5a3.5 3.5 0 0 0 0 7Z"
                                          fill="currentColor" />
                                  </svg>

                                  <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                      Settings
                                  </span>

                                  <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                                      :class="[(selected === 'Forms') ? 'menu-item-arrow-active' :
                                          'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                                      ]"
                                      width="20" height="20" viewBox="0 0 20 20" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke=""
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>
                              </a>

                              <!-- Dropdown Menu Start -->
                              <div class="overflow-hidden transform translate"
                                  :class="(selected === 'Forms') ? 'block' : 'hidden'">
                                  <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                      class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                      <li>
                                          <a href="{{ route('user-table') }}" class="menu-dropdown-item group"
                                              :class="page === 'formElements' ? 'menu-dropdown-item-active' :
                                                  'menu-dropdown-item-inactive'">
                                              User
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                              <div class="overflow-hidden transform translate"
                                  :class="(selected === 'Forms') ? 'block' : 'hidden'">
                                  <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                      class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                      <li>
                                          <a href="{{ route('role-table') }}" class="menu-dropdown-item group"
                                              :class="page === 'formElements' ? 'menu-dropdown-item-active' :
                                                  'menu-dropdown-item-inactive'">
                                              Role
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                              <!-- Dropdown Menu End -->
                          </li>
                          <!-- Menu Item Forms -->
                      </ul>
                  </div>
              </nav>
              <!-- Sidebar Menu -->
          </div>
      </aside>
      <!-- ===== Sidebar End ===== -->
