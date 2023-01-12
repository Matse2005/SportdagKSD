        <!-- Sidebar starts -->
        <div class="h-full p-3 sm:px-5 sm:py-12">
            <div
                class="absolute flex-col justify-between hidden w-64 bg-white rounded-md shadow-lg sm:relative dark:bg-gray-800 min-h-fit md:h-full sm:flex">
                <div class="px-8">
                    <ul class="my-12">
                        <div class="border-b border-gray-300 dark:border-gray-500">
                            <x-dashboard-nav-link :url="route('dashboard')" icon="objects-column" page="Dashboard"
                                :active="request()->routeIs('dashboard')" />
                            <x-dashboard-nav-link :url="route('dashboard.settings.index')" icon="calendar" page="Instellingen"
                                :active="request()->routeIs('dashboard.settings.index')" />
                        </div>
                        <div class="mt-6 border-b border-gray-300 dark:border-gray-500">
                            <x-dashboard-nav-link :url="route('dashboard.accounts.index')" icon="users" page="Accounts" :active="request()->routeIs('dashboard.accounts.index')" />
                            <x-dashboard-nav-link :url="route('dashboard.activities.index')" icon="basketball" page="Activiteiten"
                                :active="request()->routeIs('dashboard.activities.index')" />
                            <x-dashboard-nav-link :url="route('dashboard.registrations.index')" icon="calendar-lines-pen" page="Inschrijvingen"
                                :active="request()->routeIs('dashboard.registrations.index')" />
                            <x-dashboard-nav-link :url="route('dashboard.questions.index')" icon="person-circle-question" page="Vragen"
                                :active="request()->routeIs('dashboard.questions.index')" />
                            <x-dashboard-nav-link :url="route('dashboard.answers.index')" icon="square-poll-horizontal" page="Antwoorden"
                                :active="request()->routeIs('dashboard.answers.index')" />
                        </div>
                        <div class="mt-6">
                            <x-dashboard-nav-link :url="route('dashboard.export.index')" icon="file-export" page="Exporteren"
                                :active="request()->routeIs('dashboard.export.index')" />
                            <x-dashboard-nav-link :url="route('dashboard.bulk-delete.index')" icon="trash-can" page="Resetten"
                                class="hover:text-red-700" :active="request()->routeIs('dashboard.bulk-delete.index')" />
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="absolute z-40 w-64 px-3 pl-3 transition duration-150 ease-in-out sm:px-5 sm:pl-5 max-h-fit sm:hidden"
            id="mobile-nav">
            <div class="flex-col justify-between w-full h-full my-12 bg-white rounded-md shadow-lg dark:bg-gray-700">
                <button aria-label="toggle sidebar" id="openSideBar"
                    class="absolute right-0 w-10 h-10 mt-16 -mr-10 bg-gray-800 rounded-md rounded-tr rounded-br shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800"
                    onclick="sidebarHandler(true)">
                    <div
                        class="flex items-center justify-center w-full h-full rounded-sm cursor-pointer bg-ksdGreen/75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <circle cx="6" cy="10" r="2" />
                            <line x1="6" y1="4" x2="6" y2="8" />
                            <line x1="6" y1="12" x2="6" y2="20" />
                            <circle cx="12" cy="16" r="2" />
                            <line x1="12" y1="4" x2="12" y2="14" />
                            <line x1="12" y1="18" x2="12" y2="20" />
                            <circle cx="18" cy="7" r="2" />
                            <line x1="18" y1="4" x2="18" y2="5" />
                            <line x1="18" y1="9" x2="18" y2="20" />
                        </svg>
                    </div>
                </button>
                <button aria-label="Close sidebar" id="closeSideBar"
                    class="absolute right-0 hidden w-10 h-10 mt-16 -mr-10 bg-gray-800 rounded-md rounded-tr rounded-br shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800"
                    onclick="sidebarHandler(false)">
                    <div
                        class="flex items-center justify-center w-full h-full rounded-sm cursor-pointer bg-ksdGreen/75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-white icon icon-tabler icon-tabler-x"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </div>
                </button>
                <div class="px-8 pt-6">
                    <div class="flex justify-end w-full">
                    </div>
                    <ul class="py-6 ">
                        <div class="border-b border-gray-300 dark:border-gray-500">
                            <x-dashboard-nav-link :url="route('dashboard')" icon="objects-column" page="Dashboard"
                                :active="request()->routeIs('dashboard')" />
                            <x-dashboard-nav-link :url="route('dashboard.settings.index')" icon="calendar" page="Instellingen"
                                :active="request()->routeIs('dashboard.settings.index')" />
                        </div>
                        <div class="mt-6 border-b border-gray-300 dark:border-gray-500">
                            <x-dashboard-nav-link :url="route('dashboard.accounts.index')" icon="users" page="Accounts"
                                :active="request()->routeIs('dashboard.accounts.index')" />
                            <x-dashboard-nav-link :url="route('dashboard.activities.index')" icon="basketball" page="Activiteiten"
                                :active="request()->routeIs('dashboard.activities.index')" />
                            <x-dashboard-nav-link :url="route('dashboard.registrations.index')" icon="calendar-lines-pen" page="Inschrijvingen"
                                :active="request()->routeIs('dashboard.registrations.index')" />
                            <x-dashboard-nav-link :url="route('dashboard.questions.index')" icon="person-circle-question" page="Vragen"
                                :active="request()->routeIs('dashboard.questions.index')" />
                            <x-dashboard-nav-link :url="route('dashboard.answers.index')" icon="square-poll-horizontal" page="Antwoorden"
                                :active="request()->routeIs('dashboard.answers.index')" />
                        </div>
                        <div class="mt-6">
                            <x-dashboard-nav-link :url="route('dashboard.accounts.index')" icon="file-export" page="Exporteren"
                                :active="request()->routeIs('dashboard.accounts.index')" />
                            <x-dashboard-nav-link :url="route('dashboard.activities.index')" icon="trash-can" page="Resetten"
                                :active="request()->routeIs('dashboard.activities.index')" />
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidebar ends -->
