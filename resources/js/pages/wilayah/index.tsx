import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/react';
import { useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Wilayah', href: '/wilayah' },
];

interface Wilayah {
    id: number;
    nama_wilayah: string;
    provinsi: string;
    kota: string;
    kecamatan: string;
    desa: string;
    koordinat_lat: string | null;
    koordinat_lng: string | null;
    status: string;
    perangkat_jaringan_count: number;
    pelanggan_count: number;
    created_at: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginatedWilayah {
    data: Wilayah[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    links: PaginationLink[];
}

interface Props {
    wilayah: PaginatedWilayah;
    filters: {
        search?: string;
        status?: string;
    };
    [key: string]: unknown;
}

export default function WilayahIndex({ wilayah, filters }: Props) {
    const [search, setSearch] = useState(filters.search || '');
    const [status, setStatus] = useState(filters.status || '');

    const handleSearch = () => {
        router.get('/wilayah', { search, status }, {
            preserveState: true,
            preserveScroll: true,
        });
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
            case 'completed':
                return 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400';
            case 'draft':
                return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400';
            default:
                return 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400';
        }
    };

    const getStatusIcon = (status: string) => {
        switch (status) {
            case 'completed':
                return '✅';
            case 'draft':
                return '📝';
            default:
                return '❓';
        }
    };

    const getNextAction = (item: Wilayah) => {
        if (item.status === 'completed') {
            return { text: 'Lihat Detail', href: `/wilayah/${item.id}`, icon: '👁️' };
        } else if (item.perangkat_jaringan_count === 0) {
            return { text: 'Lanjut Desain', href: `/wilayah/${item.id}?step=design`, icon: '🎨' };
        } else {
            return { text: 'Lanjut RAB', href: `/wilayah/${item.id}?step=rab`, icon: '💰' };
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Manajemen Wilayah" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            🗺️ Manajemen Wilayah
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400">
                            Kelola wilayah coverage dengan 4-step wizard
                        </p>
                    </div>
                    <Link
                        href="/wilayah/create"
                        className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center space-x-2"
                    >
                        <span>➕</span>
                        <span>Tambah Wilayah</span>
                    </Link>
                </div>

                {/* Filters */}
                <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Cari Wilayah
                            </label>
                            <input
                                type="text"
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                                placeholder="Nama wilayah, provinsi, kota..."
                                className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                onKeyPress={(e) => e.key === 'Enter' && handleSearch()}
                            />
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Status
                            </label>
                            <select
                                value={status}
                                onChange={(e) => setStatus(e.target.value)}
                                className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">Semua Status</option>
                                <option value="draft">Draft</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div className="flex items-end">
                            <button
                                onClick={handleSearch}
                                className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors"
                            >
                                🔍 Cari
                            </button>
                        </div>
                    </div>
                </div>

                {/* Cards Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {wilayah.data.length > 0 ? (
                        wilayah.data.map((item) => {
                            const nextAction = getNextAction(item);
                            return (
                                <div key={item.id} className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
                                    <div className="flex items-start justify-between mb-4">
                                        <div className="flex-1">
                                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                                🏘️ {item.nama_wilayah}
                                            </h3>
                                            <div className="space-y-1 text-sm text-gray-600 dark:text-gray-400">
                                                <p>📍 {item.provinsi}, {item.kota}</p>
                                                <p>{item.kecamatan}, {item.desa}</p>
                                            </div>
                                        </div>
                                        <span className={`inline-flex items-center px-2 py-1 text-xs font-medium rounded-full ${getStatusColor(item.status)}`}>
                                            {getStatusIcon(item.status)} {item.status}
                                        </span>
                                    </div>

                                    {/* Stats */}
                                    <div className="grid grid-cols-2 gap-4 mb-4">
                                        <div className="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div className="text-2xl font-bold text-gray-900 dark:text-white">
                                                {item.perangkat_jaringan_count}
                                            </div>
                                            <div className="text-xs text-gray-600 dark:text-gray-400">
                                                📡 Perangkat
                                            </div>
                                        </div>
                                        <div className="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div className="text-2xl font-bold text-gray-900 dark:text-white">
                                                {item.pelanggan_count}
                                            </div>
                                            <div className="text-xs text-gray-600 dark:text-gray-400">
                                                👥 Pelanggan
                                            </div>
                                        </div>
                                    </div>

                                    {/* Progress Indicator */}
                                    <div className="mb-4">
                                        <div className="flex items-center justify-between text-xs text-gray-600 dark:text-gray-400 mb-2">
                                            <span>Progress Konfigurasi</span>
                                            <span>{item.status === 'completed' ? '100%' : '25%'}</span>
                                        </div>
                                        <div className="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                            <div 
                                                className={`h-2 rounded-full ${item.status === 'completed' ? 'bg-green-500 w-full' : 'bg-yellow-500 w-1/4'}`}
                                            ></div>
                                        </div>
                                        <div className="flex justify-between text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            <span>📋 Data</span>
                                            <span>🎨 Desain</span>
                                            <span>💰 RAB</span>
                                            <span>📄 Izin</span>
                                        </div>
                                    </div>

                                    {/* Coordinates */}
                                    {item.koordinat_lat && item.koordinat_lng && (
                                        <div className="mb-4 text-xs text-gray-500 dark:text-gray-400">
                                            🗺️ {item.koordinat_lat}, {item.koordinat_lng}
                                        </div>
                                    )}

                                    {/* Actions */}
                                    <div className="flex items-center justify-between">
                                        <div className="text-xs text-gray-500 dark:text-gray-400">
                                            {formatDate(item.created_at)}
                                        </div>
                                        <div className="flex items-center space-x-2">
                                            <Link
                                                href={nextAction.href}
                                                className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center space-x-1"
                                            >
                                                <span>{nextAction.icon}</span>
                                                <span>{nextAction.text}</span>
                                            </Link>
                                            <Link
                                                href={`/wilayah/${item.id}/edit`}
                                                className="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300 p-2"
                                                title="Edit"
                                            >
                                                ✏️
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            );
                        })
                    ) : (
                        <div className="col-span-full">
                            <div className="text-center py-12">
                                <div className="text-6xl mb-4">🗺️</div>
                                <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">
                                    Belum ada wilayah terdaftar
                                </h3>
                                <p className="text-gray-600 dark:text-gray-400 mb-6">
                                    Mulai dengan menambahkan wilayah coverage pertama Anda
                                </p>
                                <Link
                                    href="/wilayah/create"
                                    className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors inline-flex items-center space-x-2"
                                >
                                    <span>➕</span>
                                    <span>Tambah Wilayah Pertama</span>
                                </Link>
                            </div>
                        </div>
                    )}
                </div>

                {/* Pagination */}
                {wilayah.last_page > 1 && (
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div className="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan {((wilayah.current_page - 1) * wilayah.per_page) + 1} sampai{' '}
                                {Math.min(wilayah.current_page * wilayah.per_page, wilayah.total)} dari{' '}
                                {wilayah.total} hasil
                            </div>
                            <div className="flex items-center space-x-2">
                                {wilayah.links.map((link, index) => (
                                    <button
                                        key={index}
                                        onClick={() => link.url && router.get(link.url)}
                                        disabled={!link.url}
                                        className={`px-3 py-2 text-sm rounded-lg transition-colors ${
                                            link.active
                                                ? 'bg-blue-600 text-white'
                                                : link.url
                                                ? 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600'
                                                : 'bg-gray-100 dark:bg-gray-800 text-gray-400 cursor-not-allowed'
                                        }`}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                ))}
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}