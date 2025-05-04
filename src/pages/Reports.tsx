
import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Layout from '@/components/layout/Layout';
import { useEquipment } from '@/contexts/EquipmentContext';
import { useAuth } from '@/contexts/AuthContext';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import {
  Dialog,
  DialogContent,
  DialogFooter,
  DialogHeader,
  DialogTitle,
} from "@/components/ui/dialog";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import { format } from 'date-fns';

const Reports = () => {
  const navigate = useNavigate();
  const { user, hasRole } = useAuth();
  const { 
    damageReports, 
    updateDamageReportStatus, 
    getEquipmentById 
  } = useEquipment();

  const [selectedReportId, setSelectedReportId] = useState<string | null>(null);
  const [isUpdateStatusDialogOpen, setIsUpdateStatusDialogOpen] = useState(false);
  const [newStatus, setNewStatus] = useState<'dilaporkan' | 'dalam perbaikan' | 'sudah diperbaiki'>('dalam perbaikan');
  const [statusNotes, setStatusNotes] = useState('');
  const [statusFilter, setStatusFilter] = useState<'all' | 'dilaporkan' | 'dalam perbaikan' | 'sudah diperbaiki'>('all');
  const [searchQuery, setSearchQuery] = useState('');

  if (!user) return null;

  const filteredReports = damageReports.filter(report => {
    // Filter by status
    const matchesStatus = statusFilter === 'all' || report.status === statusFilter;
    
    // Filter by search query
    const equipment = getEquipmentById(report.equipmentId);
    const matchesSearch = searchQuery === '' || 
      (equipment && equipment.name.toLowerCase().includes(searchQuery.toLowerCase())) ||
      report.reporterName.toLowerCase().includes(searchQuery.toLowerCase()) ||
      report.description.toLowerCase().includes(searchQuery.toLowerCase());
    
    return matchesStatus && matchesSearch;
  });

  const handleStatusChange = () => {
    if (!selectedReportId || !newStatus) return;
    
    updateDamageReportStatus(selectedReportId, newStatus, statusNotes);
    setSelectedReportId(null);
    setNewStatus('dalam perbaikan');
    setStatusNotes('');
    setIsUpdateStatusDialogOpen(false);
  };

  const getStatusBadgeColor = (status: string) => {
    switch (status) {
      case 'dilaporkan': return 'bg-red-100 text-red-800';
      case 'dalam perbaikan': return 'bg-yellow-100 text-yellow-800';
      case 'sudah diperbaiki': return 'bg-green-100 text-green-800';
      default: return 'bg-gray-100 text-gray-800';
    }
  };

  return (
    <Layout>
      <div className="space-y-6">
        <div className="flex justify-between items-center">
          <h1 className="text-2xl font-bold">Laporan Kerusakan Peralatan</h1>
          {hasRole('nurse') && (
            <Button onClick={() => navigate('/lapor/new')}>
              Laporkan Kerusakan
            </Button>
          )}
        </div>

        <div className="bg-white p-6 rounded-lg shadow-sm border">
          <div className="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label htmlFor="search" className="block text-sm font-medium text-gray-700 mb-1">
                Cari Laporan
              </label>
              <Input
                id="search"
                type="text"
                placeholder="Cari berdasarkan nama peralatan, reporter, atau deskripsi..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
              />
            </div>
            <div>
              <label htmlFor="statusFilter" className="block text-sm font-medium text-gray-700 mb-1">
                Filter by Status
              </label>
              <Select
                value={statusFilter}
                onValueChange={(value) => setStatusFilter(value as any)}
              >
                <SelectTrigger id="statusFilter">
                  <SelectValue placeholder="Filter by status" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="all">All Statuses</SelectItem>
                  <SelectItem value="dilaporkan">Reported</SelectItem>
                  <SelectItem value="dalam perbaikan">In Repair</SelectItem>
                  <SelectItem value="sudah diperbaiki">Resolved</SelectItem>
                </SelectContent>
              </Select>
            </div>
          </div>

          {filteredReports.length === 0 ? (
            <div className="text-center py-8 text-gray-500">
              No damage reports found matching the current filters.
            </div>
          ) : (
            <div className="rounded-md border">
              <Table>
                <TableHeader>
                  <TableRow>
                    <TableHead>Date Reported</TableHead>
                    <TableHead>Equipment</TableHead>
                    <TableHead>Reported By</TableHead>
                    <TableHead>Description</TableHead>
                    <TableHead>Status</TableHead>
                    <TableHead className="w-[100px]">Actions</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {filteredReports
                    .sort((a, b) => new Date(b.reportDate).getTime() - new Date(a.reportDate).getTime())
                    .map((report) => {
                    const equipment = getEquipmentById(report.equipmentId);
                    
                    return (
                      <TableRow key={report.id}>
                        <TableCell>
                          {format(new Date(report.reportDate), 'dd MMM yyyy')}
                        </TableCell>
                        <TableCell>
                          {equipment ? (
                            <span className="font-medium">{equipment.name}</span>
                          ) : (
                            <span className="text-gray-500">Unknown Equipment</span>
                          )}
                        </TableCell>
                        <TableCell>{report.reporterName}</TableCell>
                        <TableCell className="max-w-xs truncate">{report.description}</TableCell>
                        <TableCell>
                          <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusBadgeColor(report.status)}`}>
                            {report.status === 'dilaporkan' ? 'dilaporkan' :
                             report.status === 'dalam perbaikan' ? 'dalam perbaikan' : 'sudah diperbaiki'}
                          </span>
                        </TableCell>
                        <TableCell>
                          <div className="flex space-x-2">
                            <Button
                              variant="outline"
                              size="sm"
                              onClick={() => {
                                navigate(`/equipment/${report.equipmentId}`);
                              }}
                            >
                              View
                            </Button>
                            
                            {hasRole(['manager', 'logistics_staff']) && report.status !== 'sudah diperbaiki' && (
                              <Button
                                variant="outline"
                                size="sm"
                                onClick={() => {
                                  setSelectedReportId(report.id);
                                  setNewStatus(report.status === 'dilaporkan' ? 'dalam perbaikan' : 'sudah diperbaiki');
                                  setIsUpdateStatusDialogOpen(true);
                                }}
                              >
                                Update
                              </Button>
                            )}
                          </div>
                        </TableCell>
                      </TableRow>
                    );
                  })}
                </TableBody>
              </Table>
            </div>
          )}
        </div>
      </div>

      {/* Update Status Dialog */}
      <Dialog open={isUpdateStatusDialogOpen} onOpenChange={setIsUpdateStatusDialogOpen}>
        <DialogContent>
          <DialogHeader>
            <DialogTitle>Update Report Status</DialogTitle>
          </DialogHeader>
          
          <div className="space-y-4 py-4">
            {selectedReportId && (
              <>
                <div className="space-y-2">
                  <label className="text-sm font-medium">New Status</label>
                  <Select
                    value={newStatus}
                    onValueChange={(value) => setNewStatus(value as any)}
                  >
                    <SelectTrigger>
                      <SelectValue placeholder="Select status" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="dilaporkan">dilaporkan</SelectItem>
                      <SelectItem value="dalam perbaikan">dalam perbaikan</SelectItem>
                      <SelectItem value="sudah diperbaiki">sudah diperbaiki</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                
                <div className="space-y-2">
                  <label className="text-sm font-medium">Notes</label>
                  <Textarea
                    placeholder="Masukkan catatan tentang pembaruan status ini"
                    value={statusNotes}
                    onChange={(e) => setStatusNotes(e.target.value)}
                  />
                </div>
                
                {newStatus === 'sudah diperbaiki' && (
                  <div className="bg-yellow-50 border border-yellow-200 rounded p-2">
                    <p className="text-sm text-yellow-800">
                    Menandai sebagai terselesaikan akan secara otomatis memperbarui status peralatan menjadi “Tersedia”.
                    </p>
                  </div>
                )}
              </>
            )}
          </div>
          
          <DialogFooter>
            <Button variant="outline" onClick={() => setIsUpdateStatusDialogOpen(false)}>
              Cancel
            </Button>
            <Button onClick={handleStatusChange}>
              Update Status
            </Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </Layout>
  );
};

export default Reports;
