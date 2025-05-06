import React from 'react';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { useNavigate } from 'react-router-dom';
import { Equipment, EquipmentHistory } from '@/types';

interface HistoryTabProps {
  equipment: Equipment[];
  history: EquipmentHistory[];
}

const HistoryTab: React.FC<HistoryTabProps> = ({ equipment, history }) => {
  const navigate = useNavigate();

  return (
    <div className="space-y-4 mt-4">
      <Card>
        <CardHeader>
          <CardTitle>Riwayat Peralatan</CardTitle>
          <CardDescription>Riwayat aktivitas semua peralatan</CardDescription>
        </CardHeader>
        <CardContent>
          <div className="space-y-4">
            {history
              .sort((a, b) => new Date(b.timestamp).getTime() - new Date(a.timestamp).getTime())
              .slice(0, 30)
              .map(item => {
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
                        {item.action === 'reported' && 'Dilaporkan sebagai rusak'}
                      </div>
                      <div className="text-xs text-muted-foreground mt-1">
                        Oleh {item.userName} • {new Date(item.timestamp).toLocaleString()}
                      </div>
                      {item.notes && (
                        <div className="text-sm mt-1 bg-muted p-2 rounded">
                          <span className="font-medium">Catatan:</span> {item.notes}
                        </div>
                      )}
                    </div>
                    <Button
                      variant="outline"
                      size="sm"
                      onClick={() => navigate(`/equipment/${item.equipmentId}`)}
                    >
                      Lihat Peralatan
                    </Button>
                  </div>
                );
              })}
          </div>
        </CardContent>
      </Card>
    </div>
  );
};

export default HistoryTab;
