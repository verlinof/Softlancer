<!-- @extends('admin.sidebar')

@section('content') -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/public/css/output.css">
</head>
<body class="bg-white">
    <!-- Sidebar Start -->
    <div class="fixed left-0 top-0 w-64 h-full bg-light py-2 pl-4 z-50 sidebar-menu transition-transform">
        <div class="pl-5">
            <img src="/public/image/logoSoftLancer.svg" alt="logo" class="h-[55px] my-4">
            <div class="flex flex-wrap pt-7">
                <div class="container relative group overflow-hidden py-3 my-2 flex items-center rounded-s-md duration-300 cursor-pointer focus-within:bg-background hover:bg-background">
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
            <div class="grid grid-cols-1 mb-6 text-active text-left">
                <div class="bg-light border border-gray-100 shadow-md shadow-black/5 rounded-md overflow-hidden">
                    <div class="p-5 flex justify-between items-center mb-4 border-b-[1px] border-stroke1">
                        <div class="text-xs font-semibold">All Company</div>
                    </div>
                    <div class="overflow-x-auto p-5">
                        <table class="w-full min-w-[540px]" data-tab-for="order">
                            <thead>
                                <tr class="font-bold text-nowrap text-center">
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu rounded-tl-md">ID</th>
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu">Logo</th>
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu">Company Name</th>
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu">Description</th>
                                    <th class="text-[12px] tracking-wide py-2 px-4 bg-abu rounded-tr-md">Action</th>
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
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke text-nowrap">
                                        <span class="text-[13px] font-medium">PT Grab Teknologi Indonesia</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">PT Grab Teknologi Indonesia adalah sebuah perusahaan yang berfokus pada teknologi dan inovasi. Perusahaan ini didedikasikan untuk menyediakan solusi teknologi terkini dan mengembangkan layanan yang memudahkan kehidupan sehari-hari. Dengan tim yang berpengalaman dan berkomitmen tinggi, PT Grab Teknologi Indonesia terus memperluas jangkauan dan meningkatkan kualitas layanannya untuk mencapai visi menjadi pemimpin dalam industri teknologi di Indonesia.</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">PT Grab Teknologi Indonesia</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">2</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Aprilia Wulandari</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke text-nowrap">
                                        <span class="text-[13px] font-medium">PT Grab Teknologi Indonesia</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">PT Grab Teknologi Indonesia adalah sebuah perusahaan yang berfokus pada teknologi dan inovasi. Perusahaan ini didedikasikan untuk menyediakan solusi teknologi terkini dan mengembangkan layanan yang memudahkan kehidupan sehari-hari. Dengan tim yang berpengalaman dan berkomitmen tinggi, PT Grab Teknologi Indonesia terus memperluas jangkauan dan meningkatkan kualitas layanannya untuk mencapai visi menjadi pemimpin dalam industri teknologi di Indonesia.</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">PT Grab Teknologi Indonesia</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 rounded-bl-md border-y-stroke">
                                        <span class="text-[13px] font-medium">3</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">Miftah Sabirah</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke text-nowrap">
                                        <span class="text-[13px] font-medium">PT Grab Teknologi Indonesia</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 border-y-stroke">
                                        <span class="text-[13px] font-medium">PT Grab Teknologi Indonesia adalah sebuah perusahaan yang berfokus pada teknologi dan inovasi. Perusahaan ini didedikasikan untuk menyediakan solusi teknologi terkini dan mengembangkan layanan yang memudahkan kehidupan sehari-hari. Dengan tim yang berpengalaman dan berkomitmen tinggi, PT Grab Teknologi Indonesia terus memperluas jangkauan dan meningkatkan kualitas layanannya untuk mencapai visi menjadi pemimpin dalam industri teknologi di Indonesia.</span>
                                    </td>
                                    <td class="py-2 px-4 border-y-[3px] bg-white1 rounded-br-md border-y-stroke">
                                        <span class="text-[13px] font-medium">miftahsabirah@mail.ugm.ac.id</span>
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

<!-- @endsection -->