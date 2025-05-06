import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '@/contexts/AuthContext';
import { useEquipment } from '@/contexts/EquipmentContext';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Button } from '@/components/ui/button';
import OverviewTab from '@/components/inventory/OverviewTab';
import HistoryTab from '@/components/inventory/HistoryTab';
import ReportsTab from '@/components/inventory/ReportsTab';

const InventoryManagerDashboard = () => {
  const { user } = useAuth();
  const { equipment, history, categories, damageReports, equipmentRequests } = useEquipment();
  const navigate = useNavigate();
  const [selectedTab, setSelectedTab] = useState('overview');

  if (!user) {
    return null;
  }

  return (
    <div className="container mx-auto py-6">
      <div className="flex justify-between items-center mb-6">
        <div>
          <h1 className="text-3xl font-bold">Dashboard Inventaris</h1>
          <p className="text-muted-foreground">Selamat datang, {user?.name}.</p>
        </div>
        <div className="flex space-x-2">
          <Button onClick={() => navigate('/categories')}>Kelola Kategori</Button>
          <Button variant="outline" onClick={() => navigate('/equipment')}>Lihat Semua Peralatan</Button>
        </div>
      </div>

      <Tabs value={selectedTab} onValueChange={setSelectedTab}>
        <TabsList className="grid w-full grid-cols-3">
          <TabsTrigger value="overview">Overview</TabsTrigger>
          <TabsTrigger value="history">Riwayat Peralatan</TabsTrigger>
          <TabsTrigger value="reports">Laporan & Permintaan</TabsTrigger>
        </TabsList>
        
        <TabsContent value="overview" className="space-y-4 mt-4">
          <OverviewTab 
            equipment={equipment}
            history={history}
            categories={categories}
            damageReports={damageReports}
            equipmentRequests={equipmentRequests}
          />
        </TabsContent>
        
        <TabsContent value="history" className="space-y-4 mt-4">
          <HistoryTab 
            equipment={equipment}
            history={history}
          />
        </TabsContent>
        
        <TabsContent value="reports" className="space-y-4 mt-4">
          <ReportsTab 
            equipment={equipment}
            damageReports={damageReports}
            equipmentRequests={equipmentRequests}
          />
        </TabsContent>
      </Tabs>
    </div>
  );
};

export default InventoryManagerDashboard;
