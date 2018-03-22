                            else {
                                $aclub_info = AclubInformation::find($value->master_id);

                                $aclub_info_attributes = $aclub_info->getAttributesImport();                                

                                foreach ($aclub_info_attributes as $aclub_info_attribute => $import) {
                                    if ($value->$import != null) {
                                        $aclub_info->$aclub_info_attribute = $value->$import;
                                        $is_info_have_attributes = True;

                                    } else {
                                        $aclub_info->$aclub_info_attribute = null;
                                    }
                                }

                                if ($is_info_have_attributes) {
                                    $aclub_info->update();
                                }
                            }