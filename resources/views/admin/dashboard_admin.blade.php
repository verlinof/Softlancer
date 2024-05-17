@extends('admin.sidebar')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softlancer</title>
    <link rel="stylesheet" href="/public/css/output.css">
</head>
<body class="bg-white">
    <!-- Sidebar Start -->
    <div class="fixed left-0 top-0 w-64 h-full bg-light py-2 pl-4 z-50 sidebar-menu transition-transform">
        <div class="pl-5">
            <img src="/public/image/logoSoftLancer.svg" alt="logo" class="h-[55px] my-4">
            <div class="flex flex-wrap pt-7">
                <div class="container relative group overflow-hidden py-3 my-2 flex items-center rounded-s-md duration-300 cursor-pointer active:bg-background hover:bg-background">
                    <div class="absolute left-0 h-full w-2 cursor-pointer duration-300 group-active:bg-primary group-hover:bg-primary"></div>
                    <span class="">Dashboard</h3>
                </div>
                <div class="container relative group overflow-hidden py-3 my-2 flex items-center rounded-s-md duration-300 cursor-pointer active:bg-background hover:bg-background">
                    <div class="absolute left-0 h-full w-2 cursor-pointer duration-300 group-active:bg-primary group-hover:bg-primary"></div>
                    <span class="">Active Users</h3>
                </div>
                <div class="container relative group overflow-hidden py-3 my-2  flex items-center rounded-s-md duration-300 cursor-pointer active:bg-background hover:bg-background">
                    <div class="absolute left-0 h-full w-2 cursor-pointer duration-300 group-active:bg-primary group-hover:bg-primary"></div>
                    <span class="">Companys Management</h3>
                </div>
                <div class="container relative group overflow-hidden py-3 my-2 flex items-center rounded-s-md duration-300 cursor-pointer active:bg-background hover:bg-background">
                    <div class="absolute left-0 h-full w-2 cursor-pointer duration-300 group-active:bg-primary group-hover:bg-primary"></div>
                    <span class="">Projects Management</h3>
                </div>
                <div class="container relative group overflow-hidden py-3 my-2 flex items-center rounded-s-md duration-300 cursor-pointer active:bg-background hover:bg-background">
                    <div class="absolute left-0 h-full w-2 cursor-pointer duration-300 group-active:bg-primary group-hover:bg-primary"></div>
                    <span class="">Handle applications</h3>
                </div>
                <button type="button" class="fixed bottom-12 text-active font-bold px-4">
                    <img src="" alt="">
                    <a href="">Logout</a>
                </button>            
            </div>
        </div>
    </div>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <div class="py-10 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <div class="flex text-lg text-primary ">
                <img src="" alt="">
                <span class="font-semibold">March 16, 2024</span>
            </div>
            <div class="absolute flex right-5">
                <div class="bg-primary rounded-lg px-5 py-3.5 text-white">A</div>
                <div class="pl-2">
                    <div class="">
                        <span class="font-semibold text-lg">Annisa Salma Rafida</span>
                        
                    </div>
                    <span class="flex text-sm">anisahslmrrr@gmail.com</span>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="w-[65%] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-light rounded-xl border border-gray-100 p-4 shadow-md shadow-black/5">
                    <div class="flex justify-between text-active">
                        <div>
                            <div class="text-6xl font-semibold mb-1">21</div>
                            <div class="text-base font-semibold">Total project</div>
                        </div>
                        <div>
                            <img src="" alt="">
                            <a href="">tes</a>
                        </div>
                    </div>
                </div>
                <div class="bg-light rounded-xl border border-gray-100 p-4 shadow-md shadow-black/5">
                    <div class="flex justify-between text-active">
                        <div>
                            <div class="text-6xl font-semibold mb-1">11</div>
                            <div class="text-base font-semibold">Projects Availlable</div>
                        </div>
                        <div>
                            <img src="" alt="">
                            <a href="">tes</a>
                        </div>
                    </div>
                </div>
                <div class="bg-light rounded-xl border border-gray-100 p-4 shadow-md shadow-black/5">
                    <div class="flex justify-between text-active">
                        <div>
                            <div class="text-6xl font-semibold mb-1">13</div>
                            <div class="text-base font-semibold">Waiting Accepted </div>
                        </div>
                        <div>
                            <img src="" alt="">
                            <a href="">tes</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6 text-active">
                <div class="bg-light border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-lg font-bold">Users Recent</div>
                        <div class="bg-white1 px-4 py-2 rounded-xl">
                            <button type="button" class="font-semibold">See All</button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[540px]" data-tab-for="order">
                            <thead>
                                <tr class="font-bold">
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu text-left rounded-tl-md">ID</th>
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu text-left">Name</th>
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu text-left rounded-tr-md">Email Address</th>
                                </tr>                            
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">1</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Annisa Salma Rafida</span>
                                    </td> 
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">anisahsalmarafida@mail.ugm.ac.id</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">2</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Aprilia Wulandari</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">apriliawulandari@mail.ugm.ac.id</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 rounded-bl-md border-y-stroke">
                                        <span class="text-[13px] font-medium">3</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Miftah Sabirah</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 rounded-be-md border-y-stroke">
                                        <span class="text-[13px] font-medium">miftahsabirah@mail.ugm.ac.id</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="bg-light border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-lg font-bold">Project Recent</div>
                        <div class="bg-white1 px-4 py-2 rounded-xl">
                            <button type="button" class="font-semibold">See All</button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[540px]" data-tab-for="order">
                            <thead>
                                <tr class="font-bold">
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu text-left rounded-tl-md">ID</th>
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu text-left">Projects Name</th>
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu text-left rounded-tr-md">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">1</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Grab Wallet</span>
                                    </td> 
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Project Grab Wallet adalah inisiatif </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">1</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Grab Wallet</span>
                                    </td> 
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Project Grab Wallet adalah inisiatif </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">1</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Grab Wallet</span>
                                    </td> 
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Project Grab Wallet adalah inisiatif </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Content End -->

    <script src="public\js\adminMain.jsx"></script>
    <script src="public\js\adminMain.js"></script>
</body>
</html>

@endsection