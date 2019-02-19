import { TestBed } from '@angular/core/testing';

import { ConsultorServiceService } from './consultor.service';

describe('ConsultorServiceService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ConsultorServiceService = TestBed.get(ConsultorServiceService);
    expect(service).toBeTruthy();
  });
});
