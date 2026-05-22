    @extends('layout.app')

    @section('title', 'Admin Dashboard')

    @section('content')

    <div class="container-fluid px-4">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6" data-aos="fade-up"
            data-aos-delay="100">

            <div>
                <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">
                    Admin Dashboard
                </h1>

                <p class="text-sm text-gray-400 font-medium mt-1">
                    Welcome back, {{ Auth::user()->name }}
                </p>
            </div>

        </div>
        {{-- ===== STAT CARDS ===== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

            <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-white/40 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-5 hover:shadow-md transition-shadow duration-200"
                data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span
                        class="text-xs px-2.5 py-1 rounded-full font-semibold bg-emerald-100 text-emerald-600 border border-emerald-200">
                        Active
                    </span>
                </div>
                <p class="text-4xl font-extrabold text-gray-800 tracking-tight">
                    {{ number_format($totalMahasiswa ?? 1247) }}</p>
                <p class="text-sm text-gray-400 font-medium mt-0.5 mb-3">Total Students</p>
                <p class="text-xs text-green-600 font-medium">↑ {{ $growthMahasiswa ?? '12%' }} <span
                        class="text-gray-400 font-normal">vs last semester</span></p>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-white/40 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-5 hover:shadow-md transition-shadow duration-200"
                data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                    </div>
                    <span
                        class="text-xs px-2.5 py-1 rounded-full font-semibold bg-emerald-100 text-emerald-600 border border-emerald-200">
                        Active
                    </span>
                </div>
                <p class="text-4xl font-extrabold text-gray-800 tracking-tight">{{ number_format($totalDosen ?? 89) }}
                </p>
                <p class="text-sm text-gray-400 font-medium mt-0.5 mb-3">Total Lecturers</p>
                <p class="text-xs text-green-600 font-medium">↑ {{ $growthDosen ?? '5%' }} <span
                        class="text-gray-400 font-normal">vs last semester</span></p>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-white/40 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-5 hover:shadow-md transition-shadow duration-200"
                data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <span
                        class="text-xs px-2.5 py-1 rounded-full font-semibold bg-emerald-100 text-emerald-600 border border-emerald-200">
                        Available
                    </span>
                </div>
                <p class="text-4xl font-extrabold text-gray-800 tracking-tight">
                    {{ number_format($totalMataKuliah ?? 156) }}</p>
                <p class="text-sm text-gray-400 font-medium mt-0.5 mb-3">Total Courses</p>
                <p class="text-xs text-green-600 font-medium">↑ {{ $growthMataKuliah ?? '8%' }} <span
                        class="text-gray-400 font-normal">vs last semester</span></p>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-white/40 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-5 hover:shadow-md transition-shadow duration-200"
                data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span
                        class="text-xs px-2.5 py-1 rounded-full font-semibold bg-emerald-100 text-emerald-600 border border-emerald-200">
                        Current
                    </span>
                </div>
                <p class="text-4xl font-extrabold text-gray-800 tracking-tight">
                    {{ number_format($totalEnrollment ?? 4892) }}</p>
                <p class="text-sm text-gray-400 font-medium mt-0.5 mb-3">Active Enrollments</p>
                <p class="text-xs text-green-600 font-medium">↑ {{ $growthEnrollment ?? '15%' }} <span
                        class="text-gray-400 font-normal">vs last semester</span></p>
            </div>

        </div>

        {{-- ===== QUICK ACCESS ===== --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-white/40 p-6 mb-6 shadow-sm"
            data-aos="fade-up" data-aos-delay="400">
            <div class="mb-4">
                <h2 class="text-lg font-bold text-gray-900">Quick Access</h2>
                <p class="text-xs text-gray-400">Frequently used administrative actions</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                {{-- Manage Courses --}}
                <a href="#" style="text-decoration: none !important;"
                    class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 hover:border-[#f9b17a] transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="500">
                    <div
                        class="w-10 h-10 flex-shrink-0 bg-gray-50 rounded-xl flex items-center justify-center group-hover:bg-[#f9b17a] transition-all duration-300">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 group-hover:text-[#f9b17a] transition-colors"
                            style="text-decoration: none !important;">Manage Courses</p>
                        <p class="text-xs text-gray-500 leading-relaxed" style="text-decoration: none !important;">
                            Organize
                            curriculum and lecturer assignments.</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-[#f9b17a] ml-auto flex-shrink-0 transition-all duration-300 group-hover:translate-x-1"
                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                {{-- Manage Students --}}
                <a href="#" style="text-decoration: none !important;"
                    class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 hover:border-[#f9b17a] transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="600">
                    <div
                        class="w-10 h-10 flex-shrink-0 bg-gray-50 rounded-xl flex items-center justify-center group-hover:bg-[#f9b17a] transition-all duration-300">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 group-hover:text-[#f9b17a] transition-colors"
                            style="text-decoration: none !important;">Manage Students</p>
                        <p class="text-xs text-gray-500 leading-relaxed" style="text-decoration: none !important;">Track
                            academic progress and enrollment data.</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-[#f9b17a] ml-auto flex-shrink-0 transition-all duration-300 group-hover:translate-x-1"
                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                {{-- Manage Lecturers --}}
                <a href="#" style="text-decoration: none !important;"
                    class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 hover:border-[#f9b17a] transition-all duration-300">
                    <div
                        class="w-10 h-10 flex-shrink-0 bg-gray-50 rounded-xl flex items-center justify-center group-hover:bg-[#f9b17a] transition-all duration-300">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 group-hover:text-[#f9b17a] transition-colors"
                            style="text-decoration: none !important;">Manage Lecturers</p>
                        <p class="text-xs text-gray-500 leading-relaxed" style="text-decoration: none !important;">
                            Update staff profiles and teaching qualifications.</p>
                    </div>

                    <svg class="w-5 h-5 text-gray-300 group-hover:text-[#f9b17a] ml-auto flex-shrink-0 transition-all duration-300 group-hover:translate-x-1"
                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
        {{-- ===== RECENT ACTIVITY ===== --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6" data-aos="fade-up"
            data-aos-delay="700">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">
                        Recent Activity
                    </h2>

                    <p class="text-sm text-gray-400 mt-1">
                        Latest system activities and updates
                    </p>
                </div>

                <a href="#"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200"
                    style="text-decoration: none !important;">

                    View All

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">

                    {{-- Table Head --}}
                    <thead class="bg-gray-50/80">
                        <tr class="border-b border-gray-100">

                            <th class="py-4 px-6 text-center text-xs font-bold uppercase tracking-wider text-gray-400">
                                Timestamp
                            </th>

                            <th class="py-4 px-6 text-center text-xs font-bold uppercase tracking-wider text-gray-400">
                                Activity
                            </th>

                            <th class="py-4 px-6 text-center text-xs font-bold uppercase tracking-wider text-gray-400">
                                User
                            </th>

                            <th class="py-4 px-6 text-center text-xs font-bold uppercase tracking-wider text-gray-400">
                                Description
                            </th>

                            <th class="py-4 px-6 text-center text-xs font-bold uppercase tracking-wider text-gray-400">
                                Status
                            </th>

                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">

                        @forelse ($aktivitas ?? [] as $item)

                        <tr class="hover:bg-gray-50/70 transition-all duration-200">

                            {{-- Timestamp --}}
                            <td class="py-5 px-4 whitespace-nowrap">
                                <p class="text-sm text-gray-500">
                                    {{ $item->timestamp }}
                                </p>
                            </td>

                            {{-- Activity --}}
                            <td class="py-5 px-4 whitespace-nowrap">

                                <div class="inline-flex items-center gap-2">

                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">

                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                                        </svg>
                                    </div>

                                    <span class="text-sm font-semibold text-gray-700">
                                        {{ $item->tipe }}
                                    </span>

                                </div>

                            </td>

                            {{-- User --}}
                            <td class="py-5 px-4 whitespace-nowrap">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center">

                                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24">

                                            <path
                                                d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />

                                        </svg>
                                    </div>

                                    <span class="text-sm font-medium text-gray-700">
                                        {{ $item->user }}
                                    </span>

                                </div>

                            </td>

                            {{-- Description --}}
                            <td class="py-5 px-4">

                                <p class="text-sm text-gray-500 leading-relaxed">
                                    {{ $item->deskripsi }}
                                </p>

                            </td>

                            {{-- Status --}}
                            <td class="py-5 px-4 text-center">

                                <span @class([ 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold'
                                    , 'bg-green-100 text-green-700'=> $item->status === 'Success',
                                    'bg-red-100 text-red-700' => $item->status === 'Failed',
                                    'bg-yellow-100 text-yellow-700' => $item->status === 'Pending',
                                    ])>

                                    {{ $item->status }}

                                </span>

                            </td>

                        </tr>

                        @empty

                        @php
                        $dummyRows = [
                        ['2025-04-07 14:32', 'Student Added', 'John Smith', 'New student registration completed',
                        'Success'],
                        ['2025-04-07 13:18', 'Course Updated', 'Dr. Sarah Johnson', 'Updated CS101 course syllabus',
                        'Success'],
                        ['2025-04-07 12:45', 'KRS Submitted', 'Emily Davis', 'Student submitted KRS for semester
                        2025/1', 'Success'],
                        ];
                        @endphp

                        @foreach ($dummyRows as $row)

                        <tr class="hover:bg-gray-50/70 transition-all duration-200">

                            {{-- Timestamp --}}
                            <td class="py-5 px-4 whitespace-nowrap">
                                <p class="text-sm text-gray-500">
                                    {{ $row[0] }}
                                </p>
                            </td>

                            {{-- Activity --}}
                            <td class="py-5 px-4 whitespace-nowrap">

                                <div class="inline-flex items-center gap-2">

                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">

                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                                        </svg>
                                    </div>

                                    <span class="text-sm font-semibold text-gray-700">
                                        {{ $row[1] }}
                                    </span>

                                </div>

                            </td>

                            {{-- User --}}
                            <td class="py-5 px-4 whitespace-nowrap">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center">

                                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24">

                                            <path
                                                d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />

                                        </svg>
                                    </div>

                                    <span class="text-sm font-medium text-gray-700">
                                        {{ $row[2] }}
                                    </span>

                                </div>

                            </td>

                            {{-- Description --}}
                            <td class="py-5 px-4">

                                <p class="text-sm text-gray-500 leading-relaxed">
                                    {{ $row[3] }}
                                </p>

                            </td>

                            {{-- Status --}}
                            <td class="py-5 px-4 text-center">

                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                                    {{ $row[4] }}

                                </span>

                            </td>

                        </tr>

                        @endforeach
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>

    </div>

    @endsection