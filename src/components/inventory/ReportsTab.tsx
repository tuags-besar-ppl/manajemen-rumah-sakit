import React from 'react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { useNavigate } from 'react-router-dom';
import { Equipment, DamageReport, EquipmentRequest } from '@/types';
import { BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';

interface ReportsTabProps {
  equipment: Equipment[];
  damageReports: DamageReport[];
  equipmentRequests: EquipmentRequest[];
}

const ReportsTab: React.FC<ReportsTabProps> = ({ 
  equipment, 
  damageReports, 
  equipmentRequests 
}) => {
  const navigate = useNavigate();
  
  // Calculate request statistics
  const pendingRequestsCount = equipmentRequests.filter(r => r.status === 'pending').length;
  const approvedRequestsCount = equipmentRequests.filter(r => r.status === 'approved').length;
  const completedRequestsCount = equipmentRequests.filter(r => r.status === 'completed').length;
  
  // Calculate damage report statistics
  const reportedDamageCount = damageReports.filter(r => r.status === 'reported').length;
  const inRepairCount = damageReports.filter(r => r.status === 'in-repair').length;
  const resolvedDamageCount = damageReports.filter(r => r.status === 'resolved').length;

  return (
    <div className="space-y-4 mt-4">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
        <Card>
          <CardHeader>
            <CardTitle>Laporan Kerusakan</CardTitle>
            <CardDescription>Status laporan kerusakan saat ini</CardDescription>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              {damageReports
                .sort((a, b) => new Date(b.reportDate).getTime() - new Date(a.reportDate).getTime())
                .slice(0, 5)
                .map(report => {
                  const equipmentItem = equipment.find(e => e.id === report.equipmentId);
                  return (
                    <div key={report.id} className="flex items-start space-x-4 border-b pb-3">
                      <div className="flex-1">
                        <div className="font-medium">{equipmentItem?.name || 'Unknown Equipment'}</div>
                        <div className="text-sm">
                          <span 
                            className={`inline-block px-2 py-1 rounded text-xs font-medium ${
                              report.status === 'reported' ? 'bg-yellow-100 text-yellow-800' : 
                              report.status === 'in-repair' ? 'bg-blue-100 text-blue-800' : 
                              'bg-green-100 text-green-800'
                            }`}
                          >
                            {report.status}
                          </span>
                          <span className="ml-2">{report.description}</span>
                        </div>
                        <div className="text-xs text-muted-foreground mt-1">
                          Reported by {report.reporterName} • {new Date(report.reportDate).toLocaleString()}
                        </div>
                      </div>
                      <Button
                        variant="outline"
                        size="sm"
                        onClick={() => navigate('/reports')}
                      >
                        Lihat Detail
                      </Button>
                    </div>
                  );
                })}
            </div>
            <div className="mt-4">
              <Button onClick={() => navigate('/reports')} className="w-full">
                Lihat Semua Laporan Kerusakan
              </Button>
            </div>
          </CardContent>
        </Card>
        
        <Card>
          <CardHeader>
            <CardTitle>Permintaan Peralatan</CardTitle>
            <CardDescription>Permintaan peralatan saat ini</CardDescription>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              {equipmentRequests
                .sort((a, b) => new Date(b.requestDate).getTime() - new Date(a.requestDate).getTime())
                .slice(0, 5)
                .map(request => {
                  const equipmentItem = equipment.find(e => e.id === request.equipmentId);
                  return (
                    <div key={request.id} className="flex items-start space-x-4 border-b pb-3">
                      <div className="flex-1">
                        <div className="font-medium">{equipmentItem?.name || 'Unknown Equipment'}</div>
                        <div className="text-sm">
                          <span 
                            className={`inline-block px-2 py-1 rounded text-xs font-medium ${
                              request.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                              request.status === 'approved' ? 'bg-blue-100 text-blue-800' : 
                              request.status === 'denied' ? 'bg-red-100 text-red-800' :
                              'bg-green-100 text-green-800'
                            }`}
                          >
                            {request.status}
                          </span>
                          <span className="ml-2">{request.reason}</span>
                        </div>
                        <div className="text-xs text-muted-foreground mt-1">
                          Requested by {request.requesterName} • {new Date(request.requestDate).toLocaleString()}
                        </div>
                      </div>
                      <Button
                        variant="outline"
                        size="sm"
                        onClick={() => navigate('/requests')}
                      >
                        Lihat Detail
                      </Button>
                    </div>
                  );
                })}
            </div>
            <div className="mt-4">
              <Button onClick={() => navigate('/requests')} className="w-full">
                Lihat Semua Permintaan Peralatan
              </Button>
            </div>
          </CardContent>
        </Card>
      </div>
      

    </div>
  );
};

export default ReportsTab;
