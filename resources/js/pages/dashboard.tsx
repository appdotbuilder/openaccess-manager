import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

interface DashboardStats {
    total_pelanggan: number;
    pelanggan_aktif: number;
    pelanggan_expired: number;
    total_wilayah: number;
    wilayah_completed: number;
    total_perangkat: number;
    tagihan_pending: number;
    tagihan_overdue: number;
    pendapatan_bulan_ini: number;
}

interface RecentCustomer {
    id: number;
    nama: string;
    kode_pelanggan: string;
    status: string;
    paket_internet: {
        nama_paket: string;
        harga_bulanan: number;
    };
    wilayah: {
        nama_wilayah: string;
    };
    created_at: string;
}

interface RecentBill {
    id: number;
    nomor_tagihan: string;
    total_bayar: number;
    tanggal_jatuh_tempo: string;
    status: string;
    pelanggan: {
        nama: string;
        kode_pelanggan: string;
    };
}

interface Props {
    stats: DashboardStats;
    recentCustomers: RecentCustomer[];
    recentBills: RecentBill[];
    [key: string]: unknown;
}

export default function Dashboard({ stats, recentCustomers, recentBills }: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(amount);
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        });
    };

    const getStatusColor = (status: string) => {
        switch (status) {
            case 'aktif':
            case 'completed':
            case 'paid':
                return 'text-green-600 bg-green-100 dark:text-green-400 dark:bg-green-900/20';
            case 'expired':
            case 'overdue':
                return 'text-red-600 bg-red-100 dark:text-red-400 dark:bg-red-900/20';
            case 'pending':
                return 'text-yellow-600 bg-yellow-100 dark:text-yellow-400 dark:bg-yellow-900/20';
            case 'draft':
                return 'text-blue-600 bg-blue-100 dark:text-blue-400 dark:bg-blue-900/20';
            default:
                return 'text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-gray-900/20';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard OpenAccess" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            🌐 Dashboard OpenAccess
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400">
                            Sistem Manajemen ISP & Network Infrastructure
                        </p>
                    </div>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Total Pelanggan</p>
                                <p className="text-3xl font-bold text-gray-900 dark:text-white">{stats.total_pelanggan}</p>
                                <p className="text-sm text-green-600 dark:text-green-400">
                                    {stats.pelanggan_aktif} aktif
                                </p>
                            </div>
                            <div className="text-4xl">👥</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Pendapatan</p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                    {formatCurrency(stats.pendapatan_bulan_ini)}
                                </p>
                                <p className="text-sm text-blue-600 dark:text-blue-400">
                                    Bulan ini
                                </p>
                            </div>
                            <div className="text-4xl">💰</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Wilayah</p>
                                <p className="text-3xl font-bold text-gray-900 dark:text-white">{stats.total_wilayah}</p>
                                <p className="text-sm text-green-600 dark:text-green-400">
                                    {stats.wilayah_completed} completed
                                </p>
                            </div>
                            <div className="text-4xl">🗺️</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Tagihan Pending</p>
                                <p className="text-3xl font-bold text-gray-900 dark:text-white">{stats.tagihan_pending}</p>
                                <p className="text-sm text-red-600 dark:text-red-400">
                                    {stats.tagihan_overdue} overdue
                                </p>
                            </div>
                            <div className="text-4xl">📄</div>
                        </div>
                    </div>
                </div>

                {/* Recent Data Grid */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Recent Customers */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                👥 Pelanggan Terbaru
                            </h3>
                        </div>
                        <div className="p-6">
                            <div className="space-y-4">
                                {recentCustomers?.length > 0 ? (
                                    recentCustomers.map((customer) => (
                                        <div key={customer.id} className="flex items-center justify-between py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                            <div className="flex-1">
                                                <p className="font-medium text-gray-900 dark:text-white">
                                                    {customer.nama}
                                                </p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    {customer.kode_pelanggan} • {customer.paket_internet?.nama_paket}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-500">
                                                    {customer.wilayah?.nama_wilayah}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <span className={`inline-flex px-2 py-1 text-xs font-medium rounded-full ${getStatusColor(customer.status)}`}>
                                                    {customer.status}
                                                </span>
                                                <p className="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                                    {formatDate(customer.created_at)}
                                                </p>
                                            </div>
                                        </div>
                                    ))
                                ) : (
                                    <p className="text-gray-500 dark:text-gray-400 text-center py-8">
                                        Belum ada pelanggan terdaftar
                                    </p>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Recent Bills */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                📄 Tagihan Pending
                            </h3>
                        </div>
                        <div className="p-6">
                            <div className="space-y-4">
                                {recentBills?.length > 0 ? (
                                    recentBills.map((bill) => (
                                        <div key={bill.id} className="flex items-center justify-between py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                            <div className="flex-1">
                                                <p className="font-medium text-gray-900 dark:text-white">
                                                    {bill.nomor_tagihan}
                                                </p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    {bill.pelanggan?.nama}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-500">
                                                    Jatuh tempo: {formatDate(bill.tanggal_jatuh_tempo)}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="font-semibold text-gray-900 dark:text-white">
                                                    {formatCurrency(bill.total_bayar)}
                                                </p>
                                                <span className={`inline-flex px-2 py-1 text-xs font-medium rounded-full ${getStatusColor(bill.status)}`}>
                                                    {bill.status}
                                                </span>
                                            </div>
                                        </div>
                                    ))
                                ) : (
                                    <p className="text-gray-500 dark:text-gray-400 text-center py-8">
                                        Tidak ada tagihan pending
                                    </p>
                                )}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                        ⚡ Quick Actions
                    </h3>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="/pelanggan/create" className="flex items-center space-x-3 p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div className="text-2xl">👤</div>
                            <div>
                                <p className="font-medium text-gray-900 dark:text-white">Tambah Pelanggan</p>
                                <p className="text-xs text-gray-500 dark:text-gray-400">Customer baru</p>
                            </div>
                        </a>
                        <a href="/wilayah/create" className="flex items-center space-x-3 p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div className="text-2xl">🗺️</div>
                            <div>
                                <p className="font-medium text-gray-900 dark:text-white">Tambah Wilayah</p>
                                <p className="text-xs text-gray-500 dark:text-gray-400">Coverage baru</p>
                            </div>
                        </a>
                        <a href="/tagihan" className="flex items-center space-x-3 p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div className="text-2xl">💰</div>
                            <div>
                                <p className="font-medium text-gray-900 dark:text-white">Kelola Billing</p>
                                <p className="text-xs text-gray-500 dark:text-gray-400">Tagihan & pembayaran</p>
                            </div>
                        </a>
                        <a href="/monitoring" className="flex items-center space-x-3 p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div className="text-2xl">📊</div>
                            <div>
                                <p className="font-medium text-gray-900 dark:text-white">Monitoring</p>
                                <p className="text-xs text-gray-500 dark:text-gray-400">Network status</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}