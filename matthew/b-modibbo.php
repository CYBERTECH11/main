<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-MODIBBO ENTERPRISE YOLA - Survey and feedback System </title>
   
</head>
<body class="font-sans bg-gray-50">
    <!-- Auth Container -->
    <div id="auth-container" class="min-h-screen flex items-center justify-center gradient-bg">
        <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-lg shadow-xl">
            <div class="text-center">
                <img src="https://via.placeholder.com/150x50?text=B+Modibbo" alt="B Modibbo Enterprise" class="mx-auto h-12">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Welcome</h2>
                <p class="mt-2 text-sm text-gray-600">Automated Survey & Feedback System</p>
            </div>
            
            <div class="text-center text-sm">
                <a href="register.php" id="toggle-register" class="cursor-pointer font-medium text-blue-600 hover:text-blue-500">Create an account</a>
                <a href="login.php" id="toggle-login" class="cursor-pointer font-medium text-blue-600 hover:text-blue-500 hidden">Already have an account? Sign in</a>
            </div>
        </div>
    </div>

    <!-- Dashboard Container (Hidden by default) -->
    <div id="dashboard-container overflow-auto" class="hidden min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 overflow-hidden left-0 w-64 bg-white shadow-lg">
            <div class="flex items-center justify-center h-16 bg-blue-600">
                <img src="https://via.placeholder.com/150x50?text=B+Modibbo" alt="B Modibbo Enterprise" class="h-10">
            </div>
            <div class="flex flex-col h-full p-4">
                <div class="flex-1 space-y-4">
                    <div class="space-y-2">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Main</h3>
                        <a href="#" id="dashboard-link" class="flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md group nav-link">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </div>
                    
                    <div class="space-y-2">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Management</h3>
                        <div class="pl-4">
                            <details class="group" open>
                                <summary class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md cursor-pointer">
                                    <i class="fas fa-users mr-3"></i>
                                    <span>Manage User</span>
                                    <i class="fas fa-chevron-down ml-auto text-xs text-gray-500 group-open:rotate-180"></i>
                                </summary>
                                <div class="mt-1 pl-8 space-y-1">
                                    <a href="#" id="customer-details-link" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md nav-sub-link">View Customer Details</a>
                                    <a href="#" id="contact-customer-link" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md nav-sub-link">Contact Customer</a>
                                </div>
                            </details>
                            
                            <details class="group" open>
                                <summary class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md cursor-pointer">
                                    <i class="fas fa-clipboard-list mr-3"></i>
                                    <span>Manage Survey</span>
                                    <i class="fas fa-chevron-down ml-auto text-xs text-gray-500 group-open:rotate-180"></i>
                                </summary>
                                <div class="mt-1 pl-8 space-y-1">
                                    <a href="#" id="view-survey-link" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md nav-sub-link">View Survey</a>
                                    <a href="#" id="edit-survey-link" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md nav-sub-link">Edit or Add Survey</a>
                                    <a href="#" id="export-survey-link" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md nav-sub-link">Export Survey</a>
                                </div>
                            </details>
                            
                            <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md">
                                <i class="fas fa-user-circle mr-3"></i>
                                Admin/Customer Profile
                            </a>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Services</h3>
                        <a href="#" id="survey-link" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md group nav-link">
                            <i class="fas fa-clipboard-check mr-3"></i>
                            Take Survey
                        </a>
                        <a href="#" id="products-link" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md group nav-link">
                            <i class="fas fa-shopping-cart mr-3"></i>
                            Order Products
                        </a>
                        <a href="#" id="about-link" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md group nav-link">
                            <i class="fas fa-info-circle mr-3"></i>
                            About Us
                        </a>
                        <a href="#" id="contact-link" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md group nav-link">
                            <i class="fas fa-envelope mr-3"></i>
                            Contact Us
                        </a>
                    </div>
                </div>
                
                <div class="pb-4">
                    <div class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md cursor-pointer" id="logout-btn">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Logout
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64 overflow-y-auto">
            <!-- Top Navigation -->
            <div class="flex items-center justify-between h-16 px-6 bg-white shadow-sm">
                <div class="flex items-center">
                    <button class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                
                <div class="flex items-center">
                    <div class="relative">
                        <button class="flex items-center text-gray-500 focus:outline-none">
                            <i class="fas fa-bell"></i>
                        </button>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </div>
                    
                    <div class="ml-4 flex items-center">
                        <div class="ml-3 relative">
                            <div class="flex items-center">
                                <div class="text-sm text-right mr-3">
                                    <div class="font-medium text-gray-900">MATHEW GABRIEL</div>
                                    <div class="text-gray-500">Admin</div>
                                </div>
                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="p-6">
                <div id="dashboard-content">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
                        <p class="text-gray-600">WELCOME TO B MODIBBO ENTERPRISE SURVEY AND FEEDBACK SYSTEM</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500">Total Surveys</p>
                                    <h3 class="text-2xl font-bold text-gray-800">1,245</h3>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <i class="fas fa-clipboard-list text-blue-600"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center text-sm text-green-500">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>12% increase</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500">Active Users</p>
                                    <h3 class="text-2xl font-bold text-gray-800">342</h3>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full">
                                    <i class="fas fa-users text-green-600"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center text-sm text-green-500">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>8% increase</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500">Pending Surveys</p>
                                    <h3 class="text-2xl font-bold text-gray-800">56</h3>
                                </div>
                                <div class="bg-yellow-100 p-3 rounded-full">
                                    <i class="fas fa-clock text-yellow-600"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center text-sm text-red-500">
                                    <i class="fas fa-arrow-down mr-1"></i>
                                    <span>3% decrease</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500">Completion Rate</p>
                                    <h3 class="text-2xl font-bold text-gray-800">89%</h3>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-full">
                                    <i class="fas fa-percentage text-purple-600"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center text-sm text-green-500">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>5% increase</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Recent Surveys</h2>
                            <button class="text-blue-600 hover:text-blue-800">View All</button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Survey Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participants</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Customer Satisfaction Q1 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">245</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Product Feedback Survey</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">189</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Employee Engagement</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">76</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Pending</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">Survey Completion</h2>
                            <div class="h-64">
                                <canvas id="surveyChart"></canvas>
                            </div>
                        </div>
                        
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <button class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                    <i class="fas fa-plus-circle text-blue-600 text-2xl mb-2"></i>
                                    <span class="text-sm font-medium text-gray-700">New Survey</span>
                                </button>
                                <button class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                                    <i class="fas fa-file-export text-green-600 text-2xl mb-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Export Data</span>
                                </button>
                                <button class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                                    <i class="fas fa-chart-pie text-purple-600 text-2xl mb-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Reports</span>
                                </button>
                                <button class="flex flex-col items-center justify-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                                    <i class="fas fa-cog text-yellow-600 text-2xl mb-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Settings</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Customer Details Content (Hidden by default) -->
                <div id="customer-details-content" class="hidden">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Customer Details</h1>
                        <p class="text-gray-600">View and manage customer information</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex space-x-4">
                                <button id="filter-active" class="px-4 py-2 bg-blue-600 text-white rounded-md">Active</button>
                                <button id="filter-inactive" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Inactive</button>
                                <button id="filter-all" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">All</button>
                            </div>
                            <div class="relative">
                                <input type="text" placeholder="Search customers..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Survey</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">John Doe</div>
                                                    <div class="text-sm text-gray-500">Customer since 2022</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">john.doe@example.com</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+234 801 234 5678</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Jan 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Amina Mohammed</div>
                                                    <div class="text-sm text-gray-500">Customer since 2021</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">amina.m@example.com</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+234 802 345 6789</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 Dec 2022</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/67.jpg" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Yusuf Bello</div>
                                                    <div class="text-sm text-gray-500">Customer since 2023</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">yusuf.bello@example.com</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+234 803 456 7890</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">New</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/28.jpg" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Fatima Abubakar</div>
                                                    <div class="text-sm text-gray-500">Customer since 2020</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">fatima.a@example.com</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+234 804 567 8901</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">22 Nov 2022</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="flex items-center justify-between mt-4">
                            <div class="text-sm text-gray-500">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">24</span> customers
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Previous</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">1</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">2</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">3</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Customer Content (Hidden by default) -->
                <div id="contact-customer-content" class="hidden">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Contact Customers</h1>
                        <p class="text-gray-600">Send messages and notifications to your customers</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2">
                                <h2 class="text-lg font-semibold text-gray-800 mb-4">Compose Message</h2>
                                <form class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Recipients</label>
                                        <div class="flex flex-wrap gap-2 mb-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                All Customers
                                                <button type="button" class="ml-1.5 inline-flex text-blue-500 hover:text-blue-700 focus:outline-none">
                                                    &times;
                                                </button>
                                            </span>
                                        </div>
                                        <select multiple class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md h-auto">
                                            <option>John Doe (john.doe@example.com)</option>
                                            <option selected>Amina Mohammed (amina.m@example.com)</option>
                                            <option>Yusuf Bello (yusuf.bello@example.com)</option>
                                            <option>Fatima Abubakar (fatima.a@example.com)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="message-subject" class="block text-sm font-medium text-gray-700">Subject</label>
                                        <input type="text" id="message-subject" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="message-content" class="block text-sm font-medium text-gray-700">Message</label>
                                        <textarea id="message-content" rows="8" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="attach-survey" name="attach-survey" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="attach-survey" class="ml-2 block text-sm text-gray-900">Attach latest survey</label>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button" class="mr-3 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Save Draft
                                        </button>
                                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Send Message
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800 mb-4">Message Templates</h2>
                                <div class="space-y-3">
                                    <div class="p-3 border border-gray-200 rounded-md cursor-pointer hover:bg-gray-50">
                                        <h3 class="text-sm font-medium text-gray-800">Survey Reminder</h3>
                                        <p class="text-xs text-gray-500 mt-1">Dear {name}, please complete our latest survey...</p>
                                    </div>
                                    <div class="p-3 border border-gray-200 rounded-md cursor-pointer hover:bg-gray-50">
                                        <h3 class="text-sm font-medium text-gray-800">New Product Announcement</h3>
                                        <p class="text-xs text-gray-500 mt-1">We're excited to introduce our new product...</p>
                                    </div>
                                    <div class="p-3 border border-gray-200 rounded-md cursor-pointer hover:bg-gray-50">
                                        <h3 class="text-sm font-medium text-gray-800">Special Offer</h3>
                                        <p class="text-xs text-gray-500 mt-1">As a valued customer, enjoy 15% off your next purchase...</p>
                                    </div>
                                    <div class="p-3 border border-gray-200 rounded-md cursor-pointer hover:bg-gray-50">
                                        <h3 class="text-sm font-medium text-gray-800">Customer Appreciation</h3>
                                        <p class="text-xs text-gray-500 mt-1">Thank you for being a loyal customer...</p>
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Messages</h2>
                                    <div class="space-y-3">
                                        <div class="p-3 bg-gray-50 rounded-md">
                                            <div class="flex justify-between">
                                                <h3 class="text-sm font-medium text-gray-800">Survey Follow-up</h3>
                                                <span class="text-xs text-gray-500">2 days ago</span>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1">Sent to 142 customers</p>
                                        </div>
                                        <div class="p-3 bg-gray-50 rounded-md">
                                            <div class="flex justify-between">
                                                <h3 class="text-sm font-medium text-gray-800">New Feature Announcement</h3>
                                                <span class="text-xs text-gray-500">1 week ago</span>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1">Sent to all customers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- View Survey Content (Hidden by default) -->
                <div id="view-survey-content" class="hidden">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">View Surveys</h1>
                        <p class="text-gray-600">Browse and analyze completed surveys</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex space-x-4">
                                <button id="filter-active-surveys" class="px-4 py-2 bg-blue-600 text-white rounded-md">Active</button>
                                <button id="filter-completed-surveys" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Completed</button>
                                <button id="filter-all-surveys" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">All</button>
                            </div>
                            <div class="relative">
                                <input type="text" placeholder="Search surveys..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Survey Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responses</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Completion Rate</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avg. Rating</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Customer Satisfaction Q1 2023</div>
                                            <div class="text-sm text-gray-500">Created: 15 Jan 2023</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">245</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-green-600 h-2.5 rounded-full" style="width: 78%"></div>
                                            </div>
                                            <div class="text-xs mt-1">78%</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4.2/5</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                            <a href="#" class="text-purple-600 hover:text-purple-900 mr-3">Analyze</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Share</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Product Feedback Survey</div>
                                            <div class="text-sm text-gray-500">Created: 5 Dec 2022</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">189</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-green-600 h-2.5 rounded-full" style="width: 92%"></div>
                                            </div>
                                            <div class="text-xs mt-1">92%</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4.5/5</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                            <a href="#" class="text-purple-600 hover:text-purple-900 mr-3">Analyze</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Share</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Employee Engagement</div>
                                            <div class="text-sm text-gray-500">Created: 22 Nov 2022</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">76</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-green-600 h-2.5 rounded-full" style="width: 65%"></div>
                                            </div>
                                            <div class="text-xs mt-1">65%</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3.8/5</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                            <a href="#" class="text-purple-600 hover:text-purple-900 mr-3">Analyze</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Share</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Market Research Q4 2022</div>
                                            <div class="text-sm text-gray-500">Created: 10 Oct 2022</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">312</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-green-600 h-2.5 rounded-full" style="width: 88%"></div>
                                            </div>
                                            <div class="text-xs mt-1">88%</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4.1/5</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                            <a href="#" class="text-purple-600 hover:text-purple-900 mr-3">Analyze</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Share</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="flex items-center justify-between mt-4">
                            <div class="text-sm text-gray-500">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">12</span> surveys
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Previous</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">1</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">2</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">3</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Edit Survey Content (Hidden by default) -->
                <div id="edit-survey-content" class="hidden">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Edit or Add Survey</h1>
                        <p class="text-gray-600">Create new surveys or modify existing ones</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <button class="px-4 py-2 bg-blue-600 text-white rounded-md mr-3">New Survey</button>
                                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Import Survey</button>
                            </div>
                            <div class="relative">
                                <input type="text" placeholder="Search surveys..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                <div class="p-4 bg-gray-50 border-b border-gray-200">
                                    <h3 class="font-medium text-gray-800">Customer Satisfaction Q1 2023</h3>
                                    <p class="text-xs text-gray-500 mt-1">Last modified: 15 Jan 2023</p>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between text-xs text-gray-500 mb-2">
                                        <span>30 questions</span>
                                        <span>245 responses</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="flex-1 px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">Edit</button>
                                        <button class="flex-1 px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">Copy</button>
                                        <button class="flex-1 px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">Delete</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                <div class="p-4 bg-gray-50 border-b border-gray-200">
                                    <h3 class="font-medium text-gray-800">Product Feedback Survey</h3>
                                    <p class="text-xs text-gray-500 mt-1">Last modified: 5 Dec 2022</p>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between text-xs text-gray-500 mb-2">
                                        <span>25 questions</span>
                                        <span>189 responses</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="flex-1 px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">Edit</button>
                                        <button class="flex-1 px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">Copy</button>
                                        <button class="flex-1 px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">Delete</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                <div class="p-4 bg-gray-50 border-b border-gray-200">
                                    <h3 class="font-medium text-gray-800">Employee Engagement</h3>
                                    <p class="text-xs text-gray-500 mt-1">Last modified: 22 Nov 2022</p>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between text-xs text-gray-500 mb-2">
                                        <span>20 questions</span>
                                        <span>76 responses</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="flex-1 px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">Edit</button>
                                        <button class="flex-1 px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">Copy</button>
                                        <button class="flex-1 px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">Delete</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                <div class="p-4 bg-gray-50 border-b border-gray-200">
                                    <h3 class="font-medium text-gray-800">Market Research Q4 2022</h3>
                                    <p class="text-xs text-gray-500 mt-1">Last modified: 10 Oct 2022</p>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between text-xs text-gray-500 mb-2">
                                        <span>35 questions</span>
                                        <span>312 responses</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="flex-1 px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">Edit</button>
                                        <button class="flex-1 px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">Copy</button>
                                        <button class="flex-1 px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">Delete</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                <div class="p-4 bg-gray-50 border-b border-gray-200">
                                    <h3 class="font-medium text-gray-800">Service Quality Assessment</h3>
                                    <p class="text-xs text-gray-500 mt-1">Last modified: 5 Sep 2022</p>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between text-xs text-gray-500 mb-2">
                                        <span>28 questions</span>
                                        <span>154 responses</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="flex-1 px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">Edit</button>
                                        <button class="flex-1 px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">Copy</button>
                                        <button class="flex-1 px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">Delete</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center p-6 cursor-pointer hover:bg-gray-50">
                                <i class="fas fa-plus-circle text-gray-400 text-3xl mb-2"></i>
                                <h3 class="font-medium text-gray-700">Create New Survey</h3>
                                <p class="text-xs text-gray-500 mt-1">Click to start from scratch</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mt-6">
                            <div class="text-sm text-gray-500">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">6</span> of <span class="font-medium">15</span> surveys
                            </div>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Previous</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">1</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">2</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">3</button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Export Survey Content (Hidden by default) -->
                <div id="export-survey-content" class="hidden">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Export Survey Data</h1>
                        <p class="text-gray-600">Download survey results in various formats</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2">
                                <h2 class="text-lg font-semibold text-gray-800 mb-4">Select Surveys to Export</h2>
                                <div class="space-y-4">
                                    <div class="flex items-center p-3 border border-gray-200 rounded-md hover:bg-gray-50">
                                        <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-800">Customer Satisfaction Q1 2023</h3>
                                            <p class="text-xs text-gray-500">245 responses | Last exported: 20 Jan 2023</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-3 border border-gray-200 rounded-md hover:bg-gray-50">
                                        <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-800">Product Feedback Survey</h3>
                                            <p class="text-xs text-gray-500">189 responses | Last exported: 10 Dec 2022</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-3 border border-gray-200 rounded-md hover:bg-gray-50">
                                        <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-800">Employee Engagement</h3>
                                            <p class="text-xs text-gray-500">76 responses | Last exported: 25 Nov 2022</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-3 border border-gray-200 rounded-md hover:bg-gray-50">
                                        <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-800">Market Research Q4 2022</h3>
                                            <p class="text-xs text-gray-500">312 responses | Last exported: 15 Oct 2022</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Export Options</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="p-4 border border-gray-200 rounded-md cursor-pointer hover:bg-gray-50">
                                            <div class="flex items-center">
                                                <i class="fas fa-file-excel text-green-600 text-2xl mr-3"></i>
                                                <div>
                                                    <h3 class="text-sm font-medium text-gray-800">Excel (XLSX)</h3>
                                                    <p class="text-xs text-gray-500">Spreadsheet format with all data</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-4 border border-gray-200 rounded-md cursor-pointer hover:bg-gray-50">
                                            <div class="flex items-center">
                                                <i class="fas fa-file-csv text-blue-600 text-2xl mr-3"></i>
                                                <div>
                                                    <h3 class="text-sm font-medium text-gray-800">CSV</h3>
                                                    <p class="text-xs text-gray-500">Comma-separated values file</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-4 border border-gray-200 rounded-md cursor-pointer hover:bg-gray-50">
                                            <div class="flex items-center">
                                                <i class="fas fa-file-pdf text-red-600 text-2xl mr-3"></i>
                                                <div>
                                                    <h3 class="text-sm font-medium text-gray-800">PDF Report</h3>
                                                    <p class="text-xs text-gray-500">Formatted report with charts</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-4 border border-gray-200 rounded-md cursor-pointer hover:bg-gray-50">
                                            <div class="flex items-center">
                                                <i class="fas fa-file-alt text-purple-600 text-2xl mr-3"></i>
                                                <div>
                                                    <h3 class="text-sm font-medium text-gray-800">JSON</h3>
                                                    <p class="text-xs text-gray-500">Structured data for developers</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-3">Export Settings</h2>
                                    <div class="space-y-3">
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label class="ml-2 block text-sm text-gray-900">Include all question types</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label class="ml-2 block text-sm text-gray-900">Include response metadata</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label class="ml-2 block text-sm text-gray-900">Include open-ended responses</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label class="ml-2 block text-sm text-gray-900">Compress into ZIP file</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6 flex justify-end">
                                    <button type="button" class="mr-3 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Save Settings
                                    </button>
                                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Export Data
                                    </button>
                                </div>
                            </div>
                            
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Exports</h2>
                                <div class="space-y-3">
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <div class="flex justify-between">
                                            <h3 class="text-sm font-medium text-gray-800">Customer Satisfaction Q1 2023</h3>
                                            <span class="text-xs text-gray-500">20 Jan</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Excel (XLSX) - 245 responses</p>
                                        <div class="mt-2 flex space-x-2">
                                            <button class="text-xs text-blue-600 hover:text-blue-800">Download</button>
                                            <button class="text-xs text-gray-600 hover:text-gray-800">Share</button>
                                        </div>
                                    </div>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <div class="flex justify-between">
                                            <h3 class="text-sm font-medium text-gray-800">Product Feedback Survey</h3>
                                            <span class="text-xs text-gray-500">10 Dec</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">PDF Report - 189 responses</p>
                                        <div class="mt-2 flex space-x-2">
                                            <button class="text-xs text-blue-600 hover:text-blue-800">Download</button>
                                            <button class="text-xs text-gray-600 hover:text-gray-800">Share</button>
                                        </div>
                                    </div>
                                    <div class="p-3 bg-gray-50 rounded-md">
                                        <div class="flex justify-between">
                                            <h3 class="text-sm font-medium text-gray-800">All Surveys Q4 2022</h3>
                                            <span class="text-xs text-gray-500">5 Dec</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">ZIP (CSV) - 577 responses</p>
                                        <div class="mt-2 flex space-x-2">
                                            <button class="text-xs text-blue-600 hover:text-blue-800">Download</button>
                                            <button class="text-xs text-gray-600 hover:text-gray-800">Share</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-3">Scheduled Exports</h2>
                                    <div class="p-3 bg-blue-50 rounded-md">
                                        <div class="flex justify-between">
                                            <h3 class="text-sm font-medium text-gray-800">Weekly Customer Feedback</h3>
                                            <span class="text-xs text-blue-600">Active</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Every Monday at 8:00 AM</p>
                                        <div class="mt-2 flex space-x-2">
                                            <button class="text-xs text-blue-600 hover:text-blue-800">Edit</button>
                                            <button class="text-xs text-gray-600 hover:text-gray-800">Pause</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Survey Content (Hidden by default) -->
                <div id="survey-content" class="hidden">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Customer Satisfaction Survey</h1>
                        <p class="text-gray-600">Please answer all questions honestly. Your feedback is valuable to us.</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Progress</span>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                    <div id="survey-progress" class="progress-bar bg-blue-600 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                            <span id="progress-text" class="text-sm font-medium text-gray-500">0/30</span>
                        </div>
                        
                        <form id="survey-form" class="space-y-8">
                            <!-- Section 1: Personal Information -->
                            <div class="survey-section">
                                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Section 1: Personal Information</h2>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">1. What is your name?</label>
                                    <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">2. What is your email address?</label>
                                    <input type="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">3. What is your age group?</label>
                                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option>Select age group</option>
                                        <option>Under 18</option>
                                        <option>18-24</option>
                                        <option>25-34</option>
                                        <option>35-44</option>
                                        <option>45-54</option>
                                        <option>55-64</option>
                                        <option>65 or older</option>
                                    </select>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">4. What is your gender?</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center">
                                            <input type="radio" name="gender" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Male</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="gender" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Female</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="gender" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Other</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="gender" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Prefer not to say</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">5. How did you hear about B Modibbo Enterprise?</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Social media</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Word of mouth</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Advertisement</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Other (please specify)</label>
                                        </div>
                                    </div>
                                    <input type="text" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Specify other">
                                </div>
                            </div>
                            
                            <!-- Section 2: Customer Experience -->
                            <div class="survey-section">
                                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Section 2: Customer Experience</h2>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">6. How satisfied are you with our products?</label>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Very Dissatisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="flex space-x-4">
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">1</span>
                                                <input type="radio" name="product-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">2</span>
                                                <input type="radio" name="product-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">3</span>
                                                <input type="radio" name="product-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">4</span>
                                                <input type="radio" name="product-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">5</span>
                                                <input type="radio" name="product-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">7. How would you rate the quality of our products?</label>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Poor</span>
                                            <span>Excellent</span>
                                        </div>
                                        <div class="flex space-x-4">
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">1</span>
                                                <input type="radio" name="product-quality" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">2</span>
                                                <input type="radio" name="product-quality" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">3</span>
                                                <input type="radio" name="product-quality" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">4</span>
                                                <input type="radio" name="product-quality" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">5</span>
                                                <input type="radio" name="product-quality" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">8. How satisfied are you with our customer service?</label>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Very Dissatisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="flex space-x-4">
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">1</span>
                                                <input type="radio" name="service-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">2</span>
                                                <input type="radio" name="service-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">3</span>
                                                <input type="radio" name="service-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">4</span>
                                                <input type="radio" name="service-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">5</span>
                                                <input type="radio" name="service-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">9. How likely are you to recommend B Modibbo Enterprise to others?</label>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Not at all likely</span>
                                            <span>Extremely likely</span>
                                        </div>
                                        <div class="flex space-x-4">
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">1</span>
                                                <input type="radio" name="recommendation" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">2</span>
                                                <input type="radio" name="recommendation" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">3</span>
                                                <input type="radio" name="recommendation" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">4</span>
                                                <input type="radio" name="recommendation" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">5</span>
                                                <input type="radio" name="recommendation" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">10. What do you like most about our products?</label>
                                    <textarea rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">11. What areas do you think we need to improve?</label>
                                    <textarea rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">12. How often do you purchase from B Modibbo Enterprise?</label>
                                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option>Select frequency</option>
                                        <option>First time</option>
                                        <option>Occasionally</option>
                                        <option>Monthly</option>
                                        <option>Weekly</option>
                                        <option>Daily</option>
                                    </select>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">13. What is your preferred method of purchase?</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center">
                                            <input type="radio" name="purchase-method" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">In-store</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="purchase-method" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Online</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="purchase-method" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Phone order</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="purchase-method" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">No preference</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">14. How satisfied are you with our pricing?</label>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Very Dissatisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="flex space-x-4">
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">1</span>
                                                <input type="radio" name="pricing-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">2</span>
                                                <input type="radio" name="pricing-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">3</span>
                                                <input type="radio" name="pricing-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">4</span>
                                                <input type="radio" name="pricing-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">5</span>
                                                <input type="radio" name="pricing-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">15. Have you experienced any issues with our products?</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center">
                                            <input type="radio" name="product-issues" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Yes</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="product-issues" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">No</label>
                                        </div>
                                    </div>
                                    <div id="issue-details" class="mt-2 hidden">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Please describe the issue:</label>
                                        <textarea rows="2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Section 3: Product Specific Questions -->
                            <div class="survey-section">
                                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Section 3: Product Specific Questions</h2>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">16. Which of our products have you purchased? (Select all that apply)</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Agricultural products</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Construction materials</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Electronics</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Household items</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Other (please specify)</label>
                                        </div>
                                    </div>
                                    <input type="text" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Specify other">
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">17. How satisfied are you with the durability of our products?</label>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Very Dissatisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="flex space-x-4">
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">1</span>
                                                <input type="radio" name="durability-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">2</span>
                                                <input type="radio" name="durability-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">3</span>
                                                <input type="radio" name="durability-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">4</span>
                                                <input type="radio" name="durability-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">5</span>
                                                <input type="radio" name="durability-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">18. How would you rate the packaging of our products?</label>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Poor</span>
                                            <span>Excellent</span>
                                        </div>
                                        <div class="flex space-x-4">
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">1</span>
                                                <input type="radio" name="packaging-rating" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">2</span>
                                                <input type="radio" name="packaging-rating" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">3</span>
                                                <input type="radio" name="packaging-rating" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">4</span>
                                                <input type="radio" name="packaging-rating" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">5</span>
                                                <input type="radio" name="packaging-rating" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">19. How satisfied are you with the delivery time of our products?</label>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Very Dissatisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="flex space-x-4">
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">1</span>
                                                <input type="radio" name="delivery-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">2</span>
                                                <input type="radio" name="delivery-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">3</span>
                                                <input type="radio" name="delivery-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">4</span>
                                                <input type="radio" name="delivery-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">5</span>
                                                <input type="radio" name="delivery-satisfaction" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">20. What new products would you like to see from us?</label>
                                    <textarea rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">21. How often do you use our products?</label>
                                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option>Select frequency</option>
                                        <option>Daily</option>
                                        <option>Weekly</option>
                                        <option>Monthly</option>
                                        <option>Occasionally</option>
                                        <option>Rarely</option>
                                    </select>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">22. Would you be interested in a loyalty program?</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center">
                                            <input type="radio" name="loyalty-program" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Yes</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="loyalty-program" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">No</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="loyalty-program" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Maybe</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">23. How important is product variety to you?</label>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Not important</span>
                                            <span>Very important</span>
                                        </div>
                                        <div class="flex space-x-4">
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">1</span>
                                                <input type="radio" name="variety-importance" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">2</span>
                                                <input type="radio" name="variety-importance" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">3</span>
                                                <input type="radio" name="variety-importance" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">4</span>
                                                <input type="radio" name="variety-importance" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">5</span>
                                                <input type="radio" name="variety-importance" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">24. Have you participated in any of our promotional offers?</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center">
                                            <input type="radio" name="promo-participation" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Yes</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="promo-participation" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">No</label>
                                        </div>
                                    </div>
                                    <div id="promo-details" class="mt-2 hidden">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Which promotional offers?</label>
                                        <textarea rows="2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">25. How satisfied are you with our return/refund policy?</label>
                                    <div class="mt-2">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Very Dissatisfied</span>
                                            <span>Very Satisfied</span>
                                        </div>
                                        <div class="flex space-x-4">
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">1</span>
                                                <input type="radio" name="return-policy" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">2</span>
                                                <input type="radio" name="return-policy" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">3</span>
                                                <input type="radio" name="return-policy" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">4</span>
                                                <input type="radio" name="return-policy" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                            <label class="flex flex-col items-center">
                                                <span class="text-xs mb-1">5</span>
                                                <input type="radio" name="return-policy" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Section 4: General Feedback -->
                            <div class="survey-section">
                                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Section 4: General Feedback</h2>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">26. How can we improve your overall experience with B Modibbo Enterprise?</label>
                                    <textarea rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">27. What additional services would you like us to offer?</label>
                                    <textarea rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">28. Do you have any suggestions for our business?</label>
                                    <textarea rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">29. Would you be interested in participating in future surveys?</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center">
                                            <input type="radio" name="future-surveys" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">Yes</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="future-surveys" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <label class="ml-2 block text-sm text-gray-700">No</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">30. Any other comments or feedback?</label>
                                    <textarea rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>
                            
                            <div class="flex justify-between mt-8">
                                <button type="button" id="prev-btn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 hidden">
                                    Previous
                                </button>
                                <button type="button" id="next-btn" class="ml-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Next
                                </button>
                                <button type="submit" id="submit-btn" class="ml-auto px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 hidden">
                                    Submit Survey
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- About Us Content (Hidden by default) -->
                <div id="about-content" class="hidden">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h1 class="text-2xl font-bold text-gray-800 mb-4">About B Modibbo Enterprise</h1>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-3">Our Story</h2>
                                <p class="text-gray-600 mb-4">
                                    Founded in Yola, B Modibbo Enterprise has been serving the community with quality products and services for over 15 years. 
                                    We started as a small family business and have grown into a trusted name in the region.
                                </p>
                                <p class="text-gray-600">
                                    Our mission is to provide exceptional value to our customers through high-quality products, excellent customer service, 
                                    and continuous innovation.
                                </p>
                            </div>
                            
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-3">Our Values</h2>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Customer satisfaction is our top priority</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Integrity in all our business dealings</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Commitment to quality products</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Continuous improvement and innovation</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Community development and support</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Our Team</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div class="bg-gray-50 p-4 rounded-lg text-center">
                                    <img src="https://via.placeholder.com/150" alt="Team Member" class="w-24 h-24 rounded-full mx-auto mb-3">
                                    <h3 class="font-medium text-gray-800">Modibbo Ahmed</h3>
                                    <p class="text-sm text-gray-600">Founder & CEO</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg text-center">
                                    <img src="https://via.placeholder.com/150" alt="Team Member" class="w-24 h-24 rounded-full mx-auto mb-3">
                                    <h3 class="font-medium text-gray-800">Aisha Modibbo</h3>
                                    <p class="text-sm text-gray-600">Operations Manager</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg text-center">
                                    <img src="https://via.placeholder.com/150" alt="Team Member" class="w-24 h-24 rounded-full mx-auto mb-3">
                                    <h3 class="font-medium text-gray-800">Yusuf Bello</h3>
                                    <p class="text-sm text-gray-600">Sales Director</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg text-center">
                                    <img src="https://via.placeholder.com/150" alt="Team Member" class="w-24 h-24 rounded-full mx-auto mb-3">
                                    <h3 class="font-medium text-gray-800">Fatima Abubakar</h3>
                                    <p class="text-sm text-gray-600">Customer Service</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Our Achievements</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-blue-50 p-4 rounded-lg text-center">
                                    <div class="text-3xl font-bold text-blue-600 mb-2">15+</div>
                                    <div class="text-gray-700">Years in Business</div>
                                </div>
                                <div class="bg-green-50 p-4 rounded-lg text-center">
                                    <div class="text-3xl font-bold text-green-600 mb-2">5000+</div>
                                    <div class="text-gray-700">Satisfied Customers</div>
                                </div>
                                <div class="bg-purple-50 p-4 rounded-lg text-center">
                                    <div class="text-3xl font-bold text-purple-600 mb-2">50+</div>
                                    <div class="text-gray-700">Products Offered</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Us Content (Hidden by default) -->
                <div id="contact-content" class="hidden">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h1 class="text-2xl font-bold text-gray-800 mb-4">Contact B Modibbo Enterprise</h1>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-3">Get in Touch</h2>
                                <form class="space-y-4">
                                    <div>
                                        <label for="contact-name" class="block text-sm font-medium text-gray-700">Your Name</label>
                                        <input type="text" id="contact-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="contact-email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                        <input type="email" id="contact-email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="contact-subject" class="block text-sm font-medium text-gray-700">Subject</label>
                                        <input type="text" id="contact-subject" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="contact-message" class="block text-sm font-medium text-gray-700">Message</label>
                                        <textarea id="contact-message" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    </div>
                                    <div>
                                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Send Message
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-3">Contact Information</h2>
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-map-marker-alt text-blue-600"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-900">Address</h3>
                                            <p class="text-sm text-gray-500">123 Enterprise Road, Yola, Adamawa State, Nigeria</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-phone-alt text-green-600"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-900">Phone</h3>
                                            <p class="text-sm text-gray-500">+234 123 456 7890</p>
                                            <p class="text-sm text-gray-500">+234 987 654 3210</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                            <i class="fas fa-envelope text-purple-600"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-900">Email</h3>
                                            <p class="text-sm text-gray-500">info@bmodibbo.com</p>
                                            <p class="text-sm text-gray-500">support@bmodibbo.com</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                            <i class="fas fa-clock text-yellow-600"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-900">Business Hours</h3>
                                            <p class="text-sm text-gray-500">Monday - Friday: 8:00 AM - 6:00 PM</p>
                                            <p class="text-sm text-gray-500">Saturday: 9:00 AM - 4:00 PM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-3">Our Location</h2>
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.923634127567!2d12.4622143147866!3d9.01204369355094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwMDAnNDMuNCJOIDEywrAyNyc1Mi4xIkU!5e0!3m2!1sen!2sng!4v1620000000000!5m2!1sen!2sng" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Products Content (Hidden by default) -->
                <div id="products-content" class="hidden">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Our Products</h1>
                        <p class="text-gray-600">Browse and order from our wide range of quality products</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="https://via.placeholder.com/400x300?text=Agricultural+Products" alt="Agricultural Products" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-800 mb-2">Agricultural Products</h3>
                                <p class="text-gray-600 mb-4">High-quality seeds, fertilizers, and farming equipment</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-800">From ₦5,000</span>
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">Order</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="https://via.placeholder.com/400x300?text=Construction+Materials" alt="Construction Materials" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-800 mb-2">Construction Materials</h3>
                                <p class="text-gray-600 mb-4">Cement, rods, blocks, and other building materials</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-800">From ₦15,000</span>
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">Order</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="https://via.placeholder.com/400x300?text=Electronics" alt="Electronics" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-800 mb-2">Electronics</h3>
                                <p class="text-gray-600 mb-4">Home appliances, gadgets, and electronic devices</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-800">From ₦25,000</span>
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">Order</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="https://via.placeholder.com/400x300?text=Household+Items" alt="Household Items" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-800 mb-2">Household Items</h3>
                                <p class="text-gray-600 mb-4">Utensils, furniture, and home essentials</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-800">From ₦7,000</span>
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">Order</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="https://via.placeholder.com/400x300?text=Food+Items" alt="Food Items" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-800 mb-2">Food Items</h3>
                                <p class="text-gray-600 mb-4">Grains, spices, and packaged food products</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-800">From ₦3,000</span>
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">Order</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="https://via.placeholder.com/400x300?text=Office+Supplies" alt="Office Supplies" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-800 mb-2">Office Supplies</h3>
                                <p class="text-gray-600 mb-4">Stationery, furniture, and office equipment</p>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-800">From ₦10,000</span>
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>