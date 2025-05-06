
import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Layout from '@/components/layout/Layout';
import { useEquipment } from '@/contexts/EquipmentContext';
import { useAuth } from '@/contexts/AuthContext';
import { Button } from '@/components/ui/button';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { Textarea } from '@/components/ui/textarea';
import { useToast } from '@/hooks/use-toast';

const NewRequest = () => {
  const navigate = useNavigate();
  const { user } = useAuth();
  const { equipment, requestEquipment } = useEquipment();
  const { toast } = useToast();
  
  const [selectedEquipmentId, setSelectedEquipmentId] = useState<string>('');
  const [reason, setReason] = useState<string>('');

  if (!user) return null;

  // Filter for available equipment only
  const availableEquipment = equipment.filter(item => item.status === 'available');

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    if (!selectedEquipmentId) {
      toast({
        title: "Error",
        description: "Silakan pilih item peralatan.",
        variant: "destructive"
      });
      return;
    }
    
    if (!reason.trim()) {
      toast({
        title: "Error",
        description: "Berikan alasan atas permintaan Anda.",
        variant: "destructive"
      });
      return;
    }
    
    requestEquipment({
      equipmentId: selectedEquipmentId,
      requesterId: user.id,
      requesterName: user.name,
      requestDate: new Date().toISOString(),
      reason,
      notes: ''
    });
    
    navigate('/requests');
  };

  return (
    <Layout>
      <div className="space-y-6">
        <div className="flex justify-between items-center">
          <h1 className="text-2xl font-bold">Permintaan Peralatan</h1>
          <Button variant="outline" onClick={() => navigate('/requests')}>
            Batal
          </Button>
        </div>

        <div className="bg-white p-6 rounded-lg shadow-sm border">
          {availableEquipment.length === 0 ? (
            <div className="text-center py-8">
              <p className="text-gray-600 mb-4">Tidak ada peralatan yang tersedia untuk diminta saat ini.</p>
              <Button onClick={() => navigate('/equipment')}>Tampilkan Semua Peralatan</Button>
            </div>
          ) : (
            <form onSubmit={handleSubmit} className="space-y-6">
              <div className="space-y-2">
                <label htmlFor="equipment" className="block text-sm font-medium text-gray-700">
                  Pilih Peralatan <span className="text-red-500">*</span>
                </label>
                <Select
                  value={selectedEquipmentId}
                  onValueChange={setSelectedEquipmentId}
                >
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih Peralatan" />
                  </SelectTrigger>
                  <SelectContent>
                    {availableEquipment.map(item => (
                      <SelectItem key={item.id} value={item.id}>
                        {item.name} - {item.location}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>
              
              <div className="space-y-2">
                <label htmlFor="reason" className="block text-sm font-medium text-gray-700">
                  Alasan Permintaan <span className="text-red-500">*</span>
                </label>
                <Textarea
                  id="reason"
                  value={reason}
                  onChange={(e) => setReason(e.target.value)}
                  placeholder="Jelaskan mengapa Anda membutuhkan peralatan ini dan untuk berapa lama"
                  rows={5}
                  required
                />
                <p className="text-xs text-gray-500">
                  Harap jelaskan secara spesifik alasan Anda memerlukan peralatan ini, untuk pasien atau prosedur mana peralatan ini ditujukan, dan berapa lama Anda memperkirakan akan membutuhkannya.
                </p>
              </div>
              
              <div className="flex justify-end space-x-2">
                <Button 
                  variant="outline" 
                  type="button" 
                  onClick={() => navigate('/requests')}
                >
                  Cancel
                </Button>
                <Button type="submit">
                  Submit Permintaan
                </Button>
              </div>
            </form>
          )}
        </div>
      </div>
    </Layout>
  );
};

export default NewRequest;
