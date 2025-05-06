import React from 'react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { PieChart, Pie, Cell, BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';
import { Equipment, EquipmentHistory, EquipmentCategory, DamageReport, EquipmentRequest } from '@/types';
import { format, subDays } from 'date-fns';
import { Button } from '@/components/ui/button';
import { useNavigate } from 'react-router-dom';

const COLORS = ['#0088FE', '#00C49F', '#FFBB28', '#FF8042'];

interface OverviewTabProps {
  equipment: Equipment[];
  history: EquipmentHistory[];
  categories: EquipmentCategory[];
  damageReports: DamageReport[];
  equipmentRequests: EquipmentRequest[];
}

const OverviewTab: React.FC<OverviewTabProps> = ({ 
  equipment, 
  history, 
  categories, 
  damageReports, 
  equipmentRequests 
}) => {
  const navigate = useNavigate();
  
  // Calculate statistics for overview
  const totalEquipment = equipment.length;
  const availableEquipment = equipment.filter(e => e.status === 'available').length;
  const inUseEquipment = equipment.filter(e => e.status === 'in-use').length;
  const damagedEquipment = equipment.filter(e => e.status === 'damaged').length;
  
  // Calculate percentages
  const availablePercentage = totalEquipment ? Math.round((availableEquipment / totalEquipment) * 100) : 0;
  const inUsePercentage = totalEquipment ? Math.round((inUseEquipment / totalEquipment) * 100) : 0;
  const damagedPercentage = totalEquipment ? Math.round((damagedEquipment / totalEquipment) * 100) : 0;
  
  // Calculate maintenance statistics
  const today = new Date();
  const needMaintenanceCount = equipment.filter(e => {
    if (!e.nextMaintenanceDate) return false;
    const maintenanceDate = new Date(e.nextMaintenanceDate);
    return maintenanceDate <= today;
  }).length;
  
  const maintenanceSoonCount = equipment.filter(e => {
    if (!e.nextMaintenanceDate) return false;
    const maintenanceDate = new Date(e.nextMaintenanceDate);
    const thirtyDaysFromNow = new Date();
    thirtyDaysFromNow.setDate(today.getDate() + 30);
    return maintenanceDate > today && maintenanceDate <= thirtyDaysFromNow;
  }).length;
  
  // Calculate request statistics
  const pendingRequestsCount = equipmentRequests.filter(r => r.status === 'pending').length;
  const approvedRequestsCount = equipmentRequests.filter(r => r.status === 'approved').length;
  
  // Calculate damage report statistics
  const reportedDamageCount = damageReports.filter(r => r.status === 'reported').length;
  const inRepairCount = damageReports.filter(r => r.status === 'in-repair').length;

  const statusData = [
    { name: 'Tersedia', value: availableEquipment },
    { name: 'Digunakan', value: inUseEquipment },
    { name: 'Rusak', value: damagedEquipment },
  ];

  // Calculate category distribution
  const categoryDistribution = categories.map(category => {
    const count = equipment.filter(e => e.category === category.name).length;
    return {
      name: category.name,
      count
    };
  }).sort((a, b) => b.count - a.count);

  // Calculate recent activity
  const recentHistory = [...history]
    .sort((a, b) => new Date(b.timestamp).getTime() - new Date(a.timestamp).getTime())
    .slice(0, 10);

  return (
    <div className="space-y-4 mt-4">
      <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
        <Card>
          <CardHeader className="pb-2">
            <CardTitle className="text-sm font-medium">Total Peralatan</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold">{totalEquipment}</div>
            <p className="text-xs text-muted-foreground mt-1">Total item inventaris</p>
          </CardContent>
        </Card>
        <Card>
          <CardHeader className="pb-2">
            <CardTitle className="text-sm font-medium">Tersedia</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold text-green-500">{availableEquipment}</div>
            <div className="flex items-center mt-1">
              <div className="w-full bg-gray-200 rounded-full h-2.5">
                <div className="bg-green-500 h-2.5 rounded-full" style={{ width: `${availablePercentage}%` }}></div>
              </div>
              <span className="text-xs text-muted-foreground ml-2">{availablePercentage}%</span>
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardHeader className="pb-2">
            <CardTitle className="text-sm font-medium">Digunakan</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold text-blue-500">{inUseEquipment}</div>
            <div className="flex items-center mt-1">
              <div className="w-full bg-gray-200 rounded-full h-2.5">
                <div className="bg-blue-500 h-2.5 rounded-full" style={{ width: `${inUsePercentage}%` }}></div>
              </div>
              <span className="text-xs text-muted-foreground ml-2">{inUsePercentage}%</span>
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardHeader className="pb-2">
            <CardTitle className="text-sm font-medium">Rusak</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold text-orange-500">{damagedEquipment}</div>
            <div className="flex items-center mt-1">
              <div className="w-full bg-gray-200 rounded-full h-2.5">
                <div className="bg-orange-500 h-2.5 rounded-full" style={{ width: `${damagedPercentage}%` }}></div>
              </div>
              <span className="text-xs text-muted-foreground ml-2">{damagedPercentage}%</span>
            </div>
          </CardContent>
        </Card>
      </div>
      
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
        <Card>
          <CardHeader className="pb-2">
            <CardTitle className="text-sm font-medium">Pemeliharaan Diperlukan</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="flex items-center">
              <div className="text-2xl font-bold text-red-500">{needMaintenanceCount}</div>
              <div className="text-sm ml-2 text-muted-foreground">item memerlukan perhatian segera</div>
            </div>
            <div className="flex items-center mt-2">
              <div className="text-lg font-medium text-yellow-500">{maintenanceSoonCount}</div>
              <div className="text-sm ml-2 text-muted-foreground">item jatuh tempo pemeliharaan dalam 30 hari</div>
            </div>
          </CardContent>
        </Card>
        
        <Card>
          <CardHeader className="pb-2">
            <CardTitle className="text-sm font-medium">Permintaan Peralatan</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="flex items-center">
              <div className="text-2xl font-bold text-blue-500">{pendingRequestsCount}</div>
              <div className="text-sm ml-2 text-muted-foreground">permintaan tertunda</div>
            </div>
            <div className="flex items-center mt-2">
              <div className="text-lg font-medium text-green-500">{approvedRequestsCount}</div>
              <div className="text-sm ml-2 text-muted-foreground">disetujui, menunggu penyelesaian</div>
            </div>
          </CardContent>
        </Card>
        
        <Card>
          <CardHeader className="pb-2">
            <CardTitle className="text-sm font-medium">Laporan Kerusakan</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="flex items-center">
              <div className="text-2xl font-bold text-red-500">{reportedDamageCount}</div>
              <div className="text-sm ml-2 text-muted-foreground">laporan baru</div>
            </div>
            <div className="flex items-center mt-2">
              <div className="text-lg font-medium text-yellow-500">{inRepairCount}</div>
              <div className="text-sm ml-2 text-muted-foreground">item sedang dalam perbaikan</div>
            </div>
          </CardContent>
        </Card>
      </div>



      <Card>
        <CardHeader>
          <CardTitle>Aktivitas Terbaru</CardTitle>
          <CardDescription>Aktivitas peralatan terkini</CardDescription>
        </CardHeader>
        <CardContent>
          <div className="space-y-4">
            {recentHistory.map(item => {
              const equipmentItem = equipment.find(e => e.id === item.equipmentId);
              return (
                <div key={item.id} className="flex items-start space-x-4 border-b pb-3">
                  <div className="flex-1">
                    <div className="font-medium">{equipmentItem?.name || 'Peralatan Tidak Dikenal'}</div>
                    <div className="text-sm text-muted-foreground">
                      {item.action === 'status_changed' && `Status berubah dari ${item.fromStatus} ke ${item.toStatus}`}
                      {item.action === 'moved' && `Dipindahkan dari ${item.fromLocation} ke ${item.toLocation}`}
                      {item.action === 'assigned' && 'Ditugaskan ke staf'}
                      {item.action === 'returned' && 'Dikembalikan ke inventaris'}
                    </div>
                    <div className="text-xs text-muted-foreground mt-1">
                      Oleh {item.userName} • {new Date(item.timestamp).toLocaleString()}
                    </div>
                  </div>
                </div>
              );
            })}
          </div>
        </CardContent>
      </Card>
    </div>
  );
};

export default OverviewTab;
