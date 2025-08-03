import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="OpenAccess Management System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 text-white">
                {/* Header Navigation */}
                <header className="w-full p-6">
                    <nav className="flex items-center justify-between max-w-7xl mx-auto">
                        <div className="flex items-center space-x-2">
                            <div className="w-8 h-8 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-lg flex items-center justify-center">
                                <span className="text-sm font-bold text-slate-900">🌐</span>
                            </div>
                            <span className="text-xl font-bold">OpenAccess</span>
                        </div>
                        <div className="flex items-center space-x-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-lg font-medium transition-colors"
                                >
                                    Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="text-slate-300 hover:text-white transition-colors"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-lg font-medium transition-colors"
                                    >
                                        Register
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                {/* Hero Section */}
                <main className="flex-1 flex items-center justify-center px-6">
                    <div className="max-w-6xl mx-auto text-center">
                        <div className="mb-8">
                            <h1 className="text-5xl md:text-6xl font-bold mb-6">
                                <span className="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                                    🚀 OpenAccess
                                </span>
                                <br />
                                <span className="text-3xl md:text-4xl">Management System</span>
                            </h1>
                            <p className="text-xl text-slate-300 mb-8 max-w-3xl mx-auto leading-relaxed">
                                Sistem manajemen lengkap untuk ISP dengan integrasi Mikrotik RouterOS, 
                                manajemen pelanggan, billing otomatis, dan monitoring jaringan real-time.
                            </p>
                        </div>

                        {/* Feature Grid */}
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                            <div className="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:bg-slate-800/70 transition-all">
                                <div className="text-3xl mb-3">👥</div>
                                <h3 className="font-semibold text-lg mb-2">Manajemen Pelanggan</h3>
                                <p className="text-slate-400 text-sm">
                                    CRUD pelanggan, integrasi PPPoE, monitoring bandwidth & traffic
                                </p>
                            </div>
                            <div className="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:bg-slate-800/70 transition-all">
                                <div className="text-3xl mb-3">🗺️</div>
                                <h3 className="font-semibold text-lg mb-2">Manajemen Wilayah</h3>
                                <p className="text-slate-400 text-sm">
                                    4-step wizard: wilayah → desain → RAB → perizinan
                                </p>
                            </div>
                            <div className="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:bg-slate-800/70 transition-all">
                                <div className="text-3xl mb-3">📡</div>
                                <h3 className="font-semibold text-lg mb-2">Perangkat Jaringan</h3>
                                <p className="text-slate-400 text-sm">
                                    Management ODC, ODP, Closure, Tiang, ONU dengan drag & drop
                                </p>
                            </div>
                            <div className="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-6 hover:bg-slate-800/70 transition-all">
                                <div className="text-3xl mb-3">💰</div>
                                <h3 className="font-semibold text-lg mb-2">Billing System</h3>
                                <p className="text-slate-400 text-sm">
                                    Tagihan otomatis, payment gateway, laporan keuangan
                                </p>
                            </div>
                        </div>

                        {/* Tech Stack */}
                        <div className="bg-slate-800/30 backdrop-blur-sm border border-slate-700/30 rounded-xl p-8 mb-8">
                            <h3 className="text-2xl font-bold mb-6">🛠️ Teknologi Terdepan</h3>
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div className="flex items-center space-x-2">
                                    <span className="w-2 h-2 bg-red-500 rounded-full"></span>
                                    <span>Laravel 11+</span>
                                </div>
                                <div className="flex items-center space-x-2">
                                    <span className="w-2 h-2 bg-blue-500 rounded-full"></span>
                                    <span>React + TypeScript</span>
                                </div>
                                <div className="flex items-center space-x-2">
                                    <span className="w-2 h-2 bg-cyan-500 rounded-full"></span>
                                    <span>Tailwind CSS</span>
                                </div>
                                <div className="flex items-center space-x-2">
                                    <span className="w-2 h-2 bg-green-500 rounded-full"></span>
                                    <span>Mikrotik API</span>
                                </div>
                                <div className="flex items-center space-x-2">
                                    <span className="w-2 h-2 bg-purple-500 rounded-full"></span>
                                    <span>Inertia.js</span>
                                </div>
                                <div className="flex items-center space-x-2">
                                    <span className="w-2 h-2 bg-yellow-500 rounded-full"></span>
                                    <span>MySQL</span>
                                </div>
                                <div className="flex items-center space-x-2">
                                    <span className="w-2 h-2 bg-orange-500 rounded-full"></span>
                                    <span>Leaflet Maps</span>
                                </div>
                                <div className="flex items-center space-x-2">
                                    <span className="w-2 h-2 bg-pink-500 rounded-full"></span>
                                    <span>Shadcn UI</span>
                                </div>
                            </div>
                        </div>

                        {/* Call to Action */}
                        <div className="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                            {!auth.user && (
                                <>
                                    <Link
                                        href={route('register')}
                                        className="bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 px-8 py-4 rounded-xl font-semibold text-lg transition-all transform hover:scale-105 shadow-lg"
                                    >
                                        🚀 Mulai Sekarang
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="bg-slate-800/70 hover:bg-slate-800 border border-slate-600 px-8 py-4 rounded-xl font-semibold text-lg transition-all"
                                    >
                                        📊 Login Dashboard
                                    </Link>
                                </>
                            )}
                            {auth.user && (
                                <Link
                                    href={route('dashboard')}
                                    className="bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 px-8 py-4 rounded-xl font-semibold text-lg transition-all transform hover:scale-105 shadow-lg"
                                >
                                    📊 Buka Dashboard
                                </Link>
                            )}
                        </div>
                    </div>
                </main>

                {/* Footer */}
                <footer className="w-full p-6 text-center text-slate-400 border-t border-slate-800">
                    <div className="max-w-7xl mx-auto">
                        <p>&copy; 2024 OpenAccess Management System. Built with ❤️ using Laravel & React</p>
                    </div>
                </footer>
            </div>
        </>
    );
}

